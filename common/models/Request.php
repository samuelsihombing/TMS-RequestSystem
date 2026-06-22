<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;
use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $business_unit_id
 * @property int $request_type_id
 * @property int $user_id
 * @property string $title
 * @property string|null $description
 * @property int $priority
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BusinessUnit $businessUnit
 * @property RequestLog[] $requestLogs
 * @property RequestType $requestType
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{

    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;
    const STATUS_COMPLETED = 4;

    const PRIORITY_LOW = 1;
    const PRIORITY_MEDIUM = 2;
    const PRIORITY_HIGH = 3;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'default', 'value' => null],
        [['priority'], 'default', 'value' => 2],
        [['status'], 'default', 'value' => 1],
        [['business_unit_id', 'request_type_id', 'user_id', 'title'], 'required'],
        [['business_unit_id', 'request_type_id', 'user_id', 'priority', 'status', 'created_at', 'updated_at'], 'integer'],
        [['description'], 'string'],
        [['title'], 'string', 'max' => 255],
        [['business_unit_id'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessUnit::class, 'targetAttribute' => ['business_unit_id' => 'id']],
        [['request_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestType::class, 'targetAttribute' => ['request_type_id' => 'id']],
        [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
         return [
        'id' => 'ID',
        'business_unit_id' => 'Business Unit',
        'request_type_id' => 'Request Type',
        'user_id' => 'Requested By',
        'title' => 'Title',
        'description' => 'Description',
        'priority' => 'Priority',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
    ];
    }
public static function getStatusLabel($status)
{
    $labels = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_APPROVED => 'Approved',
        self::STATUS_REJECTED => 'Rejected',
        self::STATUS_COMPLETED => 'Completed',
    ];
    return $labels[$status] ?? 'Unknown';
}
public static function getPriorityLabel($priority)
{
    $labels = [
        self::PRIORITY_LOW => 'Low',
        self::PRIORITY_MEDIUM => 'Medium',
        self::PRIORITY_HIGH => 'High',
    ];
    return $labels[$priority] ?? 'Unknown';
}

public function getLogs()
{
    return $this->hasMany(RequestLog::class, ['request_id' => 'id'])
        ->orderBy(['created_at' => SORT_DESC]);
}
    /**
     * Gets query for [[BusinessUnit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessUnit()
    {
        return $this->hasOne(BusinessUnit::class, ['id' => 'business_unit_id']);
    }

    /**
     * Gets query for [[RequestLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestLogs()
    {
        return $this->hasMany(RequestLog::class, ['request_id' => 'id']);
    }

    /**
     * Gets query for [[RequestType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestType()
    {
        return $this->hasOne(RequestType::class, ['id' => 'request_type_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    public function approve($userId, $note = null)
{
    $this->status = self::STATUS_APPROVED;
    if ($this->save(false)) {
        $this->addLog($userId, $note);
        return true;
    }
    return false;
}

public function reject($userId, $note = null)
{
    $this->status = self::STATUS_REJECTED;
    if ($this->save(false)) {
        $this->addLog($userId, $note);
        return true;
    }
    return false;
}

public function complete($userId, $note = null)
{
    $this->status = self::STATUS_COMPLETED;
    if ($this->save(false)) {
        $this->addLog($userId, $note);
        return true;
    }
    return false;
}

private function addLog($userId, $note)
{
    $log = new RequestLog();
    $log->request_id = $this->id;
    $log->status = $this->status;
    $log->note = $note;
    $log->changed_by = $userId;
    $log->save(false);
}
public function behaviors()
{
    return [
        TimestampBehavior::class,
    ];
}

}

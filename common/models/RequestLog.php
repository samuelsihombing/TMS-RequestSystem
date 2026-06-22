<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "request_log".
 *
 * @property int $id
 * @property int $request_id
 * @property int $status
 * @property string|null $note
 * @property int $changed_by
 * @property int $created_at
 *
 * @property User $changedBy
 * @property Request $request
 */
class RequestLog extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['note'], 'default', 'value' => null],
            [['request_id', 'status', 'changed_by', 'created_at'], 'required'],
            [['request_id', 'status', 'changed_by', 'created_at'], 'integer'],
            [['note'], 'string'],
            [['changed_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['changed_by' => 'id']],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::class, 'targetAttribute' => ['request_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_id' => 'Request ID',
            'status' => 'Status',
            'note' => 'Note',
            'changed_by' => 'Changed By',
            
        ];
    }

    /**
     * Gets query for [[ChangedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChangedBy()
    {
        return $this->hasOne(User::class, ['id' => 'changed_by']);
    }

    /**
     * Gets query for [[Request]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::class, ['id' => 'request_id']);
    }
public function behaviors()
{
    return [
        [
            'class' => TimestampBehavior::class,
            'updatedAtAttribute' => false,
        ],
    ];
}
}

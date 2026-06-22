<?php

use common\models\Request;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\RequestSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var int $totalAll */
/** @var int $totalPending */
/** @var int $totalApproved */
/** @var int $totalCompleted */

$this->title = 'Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-index">

    <div class="page-header-row">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('<i class="fa-solid fa-plus"></i> Create Request', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="row mb-3">
        <div class="col-md-3 col-6 mb-3">
            <div class="mini-stat">
                <div class="mini-stat-icon"><i class="fa-solid fa-layer-group"></i></div>
                <div>
                    <div class="mini-stat-number"><?= $totalAll ?></div>
                    <div class="mini-stat-label">Total Requests</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="mini-stat mini-stat-pending">
                <div class="mini-stat-icon"><i class="fa-solid fa-clock"></i></div>
                <div>
                    <div class="mini-stat-number"><?= $totalPending ?></div>
                    <div class="mini-stat-label">Pending</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="mini-stat mini-stat-approved">
                <div class="mini-stat-icon"><i class="fa-solid fa-check"></i></div>
                <div>
                    <div class="mini-stat-number"><?= $totalApproved ?></div>
                    <div class="mini-stat-label">Approved</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3">
            <div class="mini-stat mini-stat-completed">
                <div class="mini-stat-icon"><i class="fa-solid fa-flag-checkered"></i></div>
                <div>
                    <div class="mini-stat-number"><?= $totalCompleted ?></div>
                    <div class="mini-stat-label">Completed</div>
                </div>
            </div>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'business_unit_id',
                'label' => 'Business Unit',
                'value' => function ($model) {
                    return $model->businessUnit->name ?? '-';
                },
                'filter' => \common\models\BusinessUnit::find()->select(['name', 'id'])->indexBy('id')->column(),
            ],
            [
                'attribute' => 'request_type_id',
                'label' => 'Type',
                'value' => function ($model) {
                    return $model->requestType->name ?? '-';
                },
                'filter' => \common\models\RequestType::find()->select(['name', 'id'])->indexBy('id')->column(),
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Requested By',
                'value' => function ($model) {
                    return $model->user->username ?? '-';
                },
            ],
            'title',
            [
                'attribute' => 'priority',
                'value' => function ($model) {
                    return Request::getPriorityLabel($model->priority);
                },
                'contentOptions' => function ($model) {
                    $class = $model->priority == Request::PRIORITY_HIGH
                        ? 'priority-high'
                        : ($model->priority == Request::PRIORITY_MEDIUM ? 'priority-medium' : 'priority-low');
                    return ['class' => $class];
                },
                'filter' => [
                    1 => 'Low',
                    2 => 'Medium',
                    3 => 'High',
                ],
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return Request::getStatusLabel($model->status);
                },
                'contentOptions' => function ($model) {
                    $map = [
                        Request::STATUS_PENDING => 'status-pending',
                        Request::STATUS_APPROVED => 'status-approved',
                        Request::STATUS_REJECTED => 'status-rejected',
                        Request::STATUS_COMPLETED => 'status-completed',
                    ];
                    return ['class' => $map[$model->status] ?? ''];
                },
                'filter' => [
                    1 => 'Pending',
                    2 => 'Approved',
                    3 => 'Rejected',
                    4 => 'Completed',
                ],
            ],

            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fa-solid fa-eye"></i>', $url, ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fa-solid fa-pen"></i>', $url, ['title' => 'Update']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fa-solid fa-trash"></i>', $url, [
                            'title' => 'Delete',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
                'urlCreator' => function ($action, Request $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
            ],
        ],
    ]); ?>

</div>
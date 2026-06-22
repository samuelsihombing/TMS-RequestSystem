<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/** @var yii\web\View $this */
/** @var common\models\RequestTypeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Request Types';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-type-index">

    <div class="page-header-row">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('<i class="fa-solid fa-plus"></i> Create Request Type', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',

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
            ],
        ],
    ]); ?>

</div>
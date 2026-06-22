<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BusinessUnit $model */

$this->title = 'Update Business Unit: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Business Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="business-unit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

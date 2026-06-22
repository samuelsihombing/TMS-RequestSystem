<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\BusinessUnit $model */

$this->title = 'Create Business Unit';
$this->params['breadcrumbs'][] = ['label' => 'Business Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-unit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

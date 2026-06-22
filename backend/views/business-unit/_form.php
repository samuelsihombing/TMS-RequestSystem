<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\BusinessUnit $model */
/** @var yii\widgets\ActiveForm $form */

$isNewRecord = $model->isNewRecord;
?>

<div class="business-unit-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-section-card">
        <h3 class="form-section-title"><i class="fa-solid fa-building"></i> Business Unit Information</h3>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'e.g. Copper Rod & Wire Production']) ?>

        <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Brief description of this unit']) ?>
    </div>

    <div class="form-actions">
        <?= Html::submitButton('<i class="fa-solid fa-check"></i> ' . ($isNewRecord ? 'Create Business Unit' : 'Save Changes'), ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-cancel']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
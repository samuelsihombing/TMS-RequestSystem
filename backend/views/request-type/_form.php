<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\RequestType $model */
/** @var yii\widgets\ActiveForm $form */

$isNewRecord = $model->isNewRecord;
?>

<div class="request-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-section-card">
        <h3 class="form-section-title"><i class="fa-solid fa-tag"></i> Request Type Information</h3>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'e.g. Machine Maintenance']) ?>
    </div>

    <div class="form-actions">
        <?= Html::submitButton('<i class="fa-solid fa-check"></i> ' . ($isNewRecord ? 'Create Request Type' : 'Save Changes'), ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-cancel']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Request $model */
/** @var yii\widgets\ActiveForm $form */

$isNewRecord = $model->isNewRecord;
?>

<div class="request-form">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
        ],
    ]); ?>

    <div class="form-section-card">
        <h3 class="form-section-title"><i class="fa-solid fa-building"></i> Request Origin</h3>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'business_unit_id')->dropDownList(
                    \common\models\BusinessUnit::find()->select(['name', 'id'])->indexBy('id')->column(),
                    ['prompt' => 'Select Business Unit']
                ) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'request_type_id')->dropDownList(
                    \common\models\RequestType::find()->select(['name', 'id'])->indexBy('id')->column(),
                    ['prompt' => 'Select Request Type']
                ) ?>
            </div>
        </div>
    </div>

    <div class="form-section-card">
        <h3 class="form-section-title"><i class="fa-solid fa-align-left"></i> Request Details</h3>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'e.g. SCR Machine Overheating'])?>

        <?= $form->field($model, 'description')->textarea(['rows' => 5, 'placeholder' => 'Describe the issue or request in detail...']) ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'priority')->dropDownList([
                    1 => 'Low',
                    2 => 'Medium',
                    3 => 'High',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'status')->dropDownList([
                    1 => 'Pending',
                    2 => 'Approved',
                    3 => 'Rejected',
                    4 => 'Completed',
                ]) ?>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <?= Html::submitButton('<i class="fa-solid fa-check"></i> ' . ($isNewRecord ? 'Submit Request' : 'Save Changes'), ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-cancel']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
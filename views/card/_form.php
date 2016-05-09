<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Card */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'series')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_date')->widget(DateTimePicker::className(), [
        'language' => 'ru',
        'inline' => false,
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy:mm:dd HH:ii:ss',
            'todayBtn' => true
        ]
    ]) ?>

    <?= $form->field($model, 'expiration_date')->widget(DateTimePicker::className(), [
        'language' => 'ru',
        'inline' => false,
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy:mm:dd HH:ii:ss',
            'todayBtn' => true
        ]
    ]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'not_active' => 'Not active', 'active' => 'Active', 'overdue' => 'Overdue', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

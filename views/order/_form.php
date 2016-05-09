<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datetimepicker\DateTimePicker;
use app\models\Card;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_date')->widget(DateTimePicker::className(), [
        'language' => 'ru',
        'inline' => false,
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy:mm:dd HH:ii:ss',
            'todayBtn' => true
        ]
    ]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'card_id')->dropDownList(Card::find()->select(['id', 'id'])->indexBy('id')->column()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

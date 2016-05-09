<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form_model app\models\GeneratorForm */

$this->title = 'Cards generator';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card-generator">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php \yii\widgets\Pjax::begin() ?>
    <?php if (Yii::$app->session->hasFlash('success')) : ?>
        <div class="alert alert-success">
            Генерация карт успешно завершена
        </div>
    <?php endif ?>
    <?php $form = ActiveForm::begin([
        'id' => 'generator_form',
        'options' => [
            'data-pjax' => true,
        ],
    ]); ?>
        <?= $form->field($form_model, 'series') ?>
        <?= $form->field($form_model, 'count') ?>
        <?= $form->field($form_model, 'expiration')->dropDownList(\app\models\GeneratorForm::EXPIRATION) ?>
        <?= Html::submitButton('Создать карты', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>
    <?php \yii\widgets\Pjax::end() ?>
</div>
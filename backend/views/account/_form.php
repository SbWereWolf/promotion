<?php

use backend\models\Service;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'is_hidden')->checkbox() ?>

    <?php
    $serviceName = Service::find()
        ->select('code')
        ->where(['=', 'id', $model->service_id])
        ->scalar()
    ?>
    <?= Html::label('Сервис'); ?>
    <?= $serviceName ?>


    <?= $form->field($model, 'login')->textInput() ?>

    <?= $form->field($model, 'password')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

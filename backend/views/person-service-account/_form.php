<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PersonServiceAccount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="person-service-account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'insert_date')->textInput() ?>

    <?= $form->field($model, 'is_hidden')->checkbox() ?>

    <?= $form->field($model, 'person_id')->textInput() ?>

    <?= $form->field($model, 'service_account_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

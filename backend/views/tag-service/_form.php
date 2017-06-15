<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TagService */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tag-service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'insert_date')->textInput() ?>

    <?= $form->field($model, 'is_hidden')->checkbox() ?>

    <?= $form->field($model, 'tag_id')->textInput() ?>

    <?= $form->field($model, 'service_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

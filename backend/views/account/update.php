<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Account */

$this->title = 'Редактировать Аккаунт: ' . $model->login;
$this->params['breadcrumbs'][] = ['label' => 'Аккаунты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->login, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="account-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

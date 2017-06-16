<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Account */

$this->title = 'Добавить Аккаунт';
$this->params['breadcrumbs'][] = ['label' => 'Аккаунты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

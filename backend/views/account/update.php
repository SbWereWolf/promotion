<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\Account */
/* @var $tagProvider yii\data\ActiveDataProvider */

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
<div>

    <p>
        <?= Html::a('Добавить тег', ['tag/link', 'account_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(
        [
            'id' => 'pjax-grid-view',
            'linkSelector' => '.pjax-reload',
            'timeout'=>9999
        ]
    ); ?>
    <?=

    $this->render('tag_account', [
        'accountProvider' => $tagProvider,
    ]);

    ?>

    <?php Pjax::end(); ?>

</div>

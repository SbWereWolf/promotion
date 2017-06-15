<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AccountPost */

$this->title = 'Create Account Post';
$this->params['breadcrumbs'][] = ['label' => 'Account Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

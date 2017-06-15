<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PersonServiceAccount */

$this->title = 'Create Person Service Account';
$this->params['breadcrumbs'][] = ['label' => 'Person Service Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-service-account-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

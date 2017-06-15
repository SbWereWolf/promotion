<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ServiceAccount */

$this->title = 'Create Service Account';
$this->params['breadcrumbs'][] = ['label' => 'Service Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-account-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

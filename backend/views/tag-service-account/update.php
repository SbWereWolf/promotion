<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TagServiceAccount */

$this->title = 'Update Tag Service Account: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tag Service Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tag-service-account-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

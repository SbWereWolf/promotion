<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TagServiceAccount */

$this->title = 'Create Tag Service Account';
$this->params['breadcrumbs'][] = ['label' => 'Tag Service Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-service-account-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TagAccount */

$this->title = 'Create Tag Account';
$this->params['breadcrumbs'][] = ['label' => 'Tag Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-account-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PersonAccount */

$this->title = 'Create Person Account';
$this->params['breadcrumbs'][] = ['label' => 'Person Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-account-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

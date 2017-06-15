<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TagService */

$this->title = 'Create Tag Service';
$this->params['breadcrumbs'][] = ['label' => 'Tag Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

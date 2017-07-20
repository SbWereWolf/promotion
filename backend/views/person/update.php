<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\Person */
/* @var $accountProvider yii\data\ActiveDataProvider */

$this->title = 'Update Person: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="person-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <p>
        <?= Html::a('Добавить аккаунт', ['account/link', 'person_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(['id' => 'pjax-grid-view']); ?>
<?=

    $this->render('person_account', [
    'accountProvider' => $accountProvider,
    ]);

    ?>

    <?php Pjax::end(); ?>
</div>

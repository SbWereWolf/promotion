<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Person */
/* @var $accountProvider yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'insert_date',
            'is_hidden:boolean',
            'code:ntext',
            'title:ntext',
            'description:ntext',
        ],
    ]) ?>

</div>


<div>

    <?= GridView::widget([
        'dataProvider' => $accountProvider,
        'showOnEmpty'=>true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'service:html:Сервис',
            [
                'attribute' => 'login',
                'label' => 'Логин',
                'content'=>function($data){
                    return Html::a($data['login'], ['account/view', 'id' => $data['id']]);
                }
            ],
            'password:html:Пароль',
            'description:ntext:Примечание',

        ],
    ]); ?>

</div>

<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $accountProvider yii\data\ActiveDataProvider */

?>
    <?= GridView::widget([
        'dataProvider' => $accountProvider,
        'showOnEmpty'=>true,
        'options'=>['id'=>'idGridView'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'service:html:Сервис',
            [
                'attribute' => 'login',
                'label' => 'Логин',
                'content'=>function($data){
                    return Html::a($data['login'], ['account/view', 'id' => $data['account_id']]);
                }
            ],
            'password:html:Пароль',
            'description:ntext:Примечание',
            [
                'label' => 'Удалить',
                'content'=>function($data){
                    return Html::a('Удалить', ['person/unlink', 'account_id' => $data['account_id'],'person_id' => $data['person_id']]);
                }
            ],

        ],
    ]); ?>

<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $accountProvider yii\data\ActiveDataProvider */

?>
<h2>Теги аккаунта</h2>
<?= GridView::widget([
    'dataProvider' => $accountProvider,
    'showOnEmpty' => true,
    'options' => ['id' => 'TagGridView'],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'code',
            'label' => 'Код ',
            'content' => function ($data) {
                return Html::a($data['code'], ['tag/view', 'id' => $data['tag_id']]);
            }
        ],
        'title:html:Наименование',
        'description:ntext:Примечание',
        [
            'label' => 'Удалить',
            'content' => function ($data) {
                return Html::a('Удалить',
                    [
                        'account/unlink',
                        'account_id' => $data['account_id'],
                        'tag_id' => $data['tag_id']
                    ],
                    ['class' => 'pjax-reload']);
            }
        ],

    ],
]); ?>

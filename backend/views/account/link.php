<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $person_id */
/* @var $person backend\models\Person */

$this->title = 'Аккаунты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-link">

    <h1><?= Html::encode($this->title) ?></h1>
    <div>

        <?= DetailView::widget([
            'model' => $person,
            'attributes' => [
                'is_hidden:boolean',
                'code:text',
                'title:text',
                'description:ntext',
            ],
        ]) ?>
    </div>

    <div>
        <p>
            <?= Html::button('Добавить аккаунт', ['class' => 'btn btn-success link-account']) ?>
            <?= Html::a('Отмена', ['person/view', 'id' => $person->id], ['class' => 'btn btn-danger']) ?>
        </p>

        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'id' => 'account-grid',
            'rowOptions' => function ($model, $key, $index, $grid) {
                return [
                    'data' => ['key' => $model['account_id']]
                ];
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                ['class' => 'yii\grid\CheckboxColumn'],

                'is_hidden:boolean',
                'service:text:Сервис',
                'login:text',
                'password:text',
                'description:ntext',
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>

    <?php

$urlToPersonView = Url::toRoute(['person/view', 'id' => $person->id]);
$urlForLinkAccountWithPerson = Url::toRoute(['person-account/link']);

$script = "
        $('.link-account').click(function(){

            var keys = $('#account-grid').yiiGridView('getSelectedRows');
            $.post({
                url: '$urlForLinkAccountWithPerson',
                dataType: 'text',
                data: {key_list: keys, person_id: $person->id},
                success: function (data, textStatus, jqXHR) {
                    window.location = '$urlToPersonView';
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('textStatus :' + textStatus + '; errorThrown :' + errorThrown + ';');
                }
            })

        });

" ;

    $this->registerJs($script, yii\web\View::POS_READY);

    ?>

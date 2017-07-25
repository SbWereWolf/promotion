<?php

use backend\models\Service;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $account backend\models\Account */
/* @var $account_id int */

$this->title = 'Tags';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="account-view">

    <?= DetailView::widget([
        'model' => $account,
        'attributes' => [
            'is_hidden:boolean',
            [
                'attribute' => 'service_id',
                'label' => 'Сервис',
                'value' => function ($model) {
                    $serviceCode = Service::find()
                        ->select('code')
                        ->where(['=', 'id', $model->service_id])
                        ->scalar();

                    return $serviceCode;
                },
                'format' => 'raw',
            ],
            'login:text',
            'password:text',
            'description:ntext',
        ],
    ]) ?>
</div>

<div class="tag-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::button('Добавить тег', ['class' => 'btn btn-success link-tag']) ?>
        <?= Html::a('Отмена', ['account/view', 'id' => $account->id], ['class' => 'btn btn-danger']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'tag-grid',
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'data' => ['key' => $model['tag_id']]
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['class' => 'yii\grid\CheckboxColumn'],

            'is_hidden:boolean',
            'code:text',
            'title:text',
            'description:ntext',
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>

<?php
$urlToAccountView = Url::toRoute(['account/view', 'id' => $account->id]);
$urlForLinkAccountWithTag = Url::toRoute(['tag-account/link']);

$script = "
$('.link-tag').click(function(){

var keys = $('#tag-grid').yiiGridView('getSelectedRows');
$.post({
url: '$urlForLinkAccountWithTag',
dataType: 'text',
data: {key_list: keys, account_id: $account->id},
success: function (data, textStatus, jqXHR) {
window.location = '$urlToAccountView';
},
error: function (jqXHR, textStatus, errorThrown) {
alert('textStatus :' + textStatus + '; errorThrown :' + errorThrown + ';');
}
})

});

" ;

$this->registerJs($script, yii\web\View::POS_READY);

?>

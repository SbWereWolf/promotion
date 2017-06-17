<?php

use backend\models\Service;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Аккаунты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p><a class="btn btn-default" href="<?= Url::to(['account/free_proxy']); ?>">Просмотр сободных Прокси</a></p>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'is_hidden:boolean',
            //'service_id',
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
            'login:ntext',
            'password:ntext',
            'description:ntext',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} или {view} ',],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

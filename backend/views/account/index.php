<?php

use yii\helpers\Html;
use yii\grid\GridView;
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

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'is_hidden:boolean',
            'service_id',
            'login:ntext',
            'password:ntext',
            'description:ntext',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} или {view} ',],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

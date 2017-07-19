<?php

use yii\grid\GridView;
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

    <?php Pjax::begin(); ?>
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
                    return Html::a('Удалить', ['person-account/unlink', 'account_id' => $data['account_id'],'person_id' => $data['person_id']],['onClick'=>'unlink_click()']);
                }
            ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<script>
    function unlink_click(){
        alert('START');
            var $this = $(this);
            var href = $this.attr('href');
            $.get(href, function(){
                $.pjax.reload({container: '#idGridView'});
            });
        alert('FINISH');
            return false;
    }
</script>

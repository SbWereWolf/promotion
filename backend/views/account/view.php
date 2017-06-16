<?php

use backend\models\Service;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Account */

$this->title = $model->login;
$this->params['breadcrumbs'][] = ['label' => 'Аккаунты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>

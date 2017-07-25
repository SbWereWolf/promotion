<?php

use backend\models\Service;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Account */
/* @var $tagProvider yii\data\ActiveDataProvider */
/* @var $person backend\models\Person */

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
            'login:text',
            'password:text',
            'description:ntext',
        ],
    ]) ?>

</div>
<div>
    <h2>Ссылка на Персону</h2>
    <?php

    $isEmpty = empty($person);

    $isExists = false;
    if (!$isEmpty) {
        $isExists = !empty($person->id);
    }

    $personLink = '';
    if ($isExists) {
        $personLink = Url::toRoute( ['person/view','id' => $person->id]);
    }
    ?>
    <?= $personLink == '' ? '' : Html::a($person->code, $personLink) ?>
</div>

<div>
    <h2>Теги</h2>

    <?= GridView::widget([
        'dataProvider' => $tagProvider,
        'showOnEmpty' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code:html:Пароль',
            'title:html:Пароль',
            'description:ntext:Примечание',

        ],
    ]); ?>

</div>

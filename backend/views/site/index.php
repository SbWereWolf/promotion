<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'ROBOTS Corporation Inventory';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>ROBOTS Corporation Inventory</h1>

        <p class="lead">Operator menu</p>
        <p><a class="btn btn-default" href="<?= Url::to(['site/inventory']); ?>">Просмотр Инвенторя</a></p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-2">
                <h2>Person</h2>
                <p>Люди используют Сервисы с помощью Аккаунтов.</p>
                <p><a class="btn btn-default" href="<?= Url::to(['person/index']); ?>">Работать с Людьми</a></p>
            </div>
            <div class="col-lg-2">
                <h2>Сервисы</h2>
                <p>Сервисы которыми могут воспользоваться Люди.</p>
                <p><a class="btn btn-default" href="<?= Url::to(['service/index']); ?>">Работать с Сервисами</a></p>
            </div>
            <div class="col-lg-3">
                <h2>Аккаунты</h2>
                <p>Аккаунты зареганные на Сервисах.</p>
                <p><a class="btn btn-default" href="<?= Url::to(['account/index']); ?>">Работать с Аккаунтами</a></p>
            </div>
            <div class="col-lg-3">
                <h2>Заметки</h2>
                <p>Заметки для размещения на сервисах.</p>
                <p><a class="btn btn-default" href="<?= Url::to(['post/index']); ?>">Работать с Заметками</a></p>
            </div>
            <div class="col-lg-2">
                <h2>Tag</h2>
                <p>Тэги - ярлычки которые при необходимости можно прикрепить к Персоне, Сервису, Аккаунту или Посту.</p>
            </div>
        </div>

    </div>
</div>

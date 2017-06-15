<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'ROBOTS Corporation Inventory';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>ROBOTS Corporation Inventory</h1>

        <p class="lead">Operator menu</p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-2">
                <h2>Person</h2>
                <p>Персоны используют Сервисы с помощью Аккаунтов.</p>
            </div>
            <div class="col-lg-2">
                <h2>Service</h2>
                <p>Сервисы которыми могут воспользоваться Персоны.</p>
            </div>
            <div class="col-lg-3">
                <h2>Account</h2>
                <p>Аккаунты зареганные на Сервисах.</p>
            </div>
            <div class="col-lg-3">
                <h2>Post</h2>
                <p>Посты для размещения на сервисах.</p>
                <p><a class="btn btn-default" href="<?= Url::to(['post/index']); ?>">Работать с Постави</a></p>
            </div>
            <div class="col-lg-2">
                <h2>Tag</h2>
                <p>Тэги - ярлычки которые при необходимости можно прикрепить к Персоне, Сервису, Аккаунту или Посту.</p>
            </div>
        </div>

    </div>
</div>

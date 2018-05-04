<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link rel="icon" type="image/png" href="/picture/titleimage.png" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Ticket System</title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $buttons = [
            ['label' => 'Főoldal', 'url' => ['/site/index']],
            ['label' => 'Rólunk', 'url' => ['/site/about']],
            ['label' => 'Írj nekünk', 'url' => ['/site/contact']],
            ['label' => 'Regisztráció', 'url' => ['/user/create']],
            ['label' => 'Belépés', 'url' => ['/site/login']],
        ];
    }
    else if (!Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin()) {
        $buttons = [

            ['label' => 'Főoldal', 'url' => ['/site/index']],
            ['label' => 'Ticketeim', 'url' => ['/ticket/ticketfromuser?id=' . Yii::$app->user->identity->id]],
            ['label' => 'Adataim', 'url' => ['/user/view?id=' . Yii::$app->user->identity->id]],
            '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Kilépés (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']). Html::endForm()
          ];
    } else {
        $buttons = [
            ['label' => 'Főoldal', 'url' => ['/site/index']],
            ['label' => 'Lezárt ticketek', 'url' => ['/ticket/closedlist']],
            ['label' => 'Új admin létrehozása', 'url' => ['/user/create']],
            ['label' => 'Felhasználók', 'url' => ['/user/']],
            ['label' => 'Többi admin', 'url' => ['/user/adminlist']],
            '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Kilépés (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']). Html::endForm()
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $buttons,
    ]);

    NavBar::end();
    ?>

    <div class="container">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?php if (Yii::$app->session->hasFlash('error')): ?>
                <?= Yii::$app->session->getFlash('error') ?>
        <?php endif; ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">@ Ticket System 2018</p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

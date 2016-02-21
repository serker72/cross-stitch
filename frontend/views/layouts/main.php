<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/main/default/index']],
        ['label' => 'Работы', 'items' => [
            ['label' => 'Вышивание', 'url' => ['/main/posts/index?category_id=1']],
            ['label' => 'Вязание', 'url' => ['/main/posts/index?category_id=2']],
        ]],
        ['label' => 'About', 'url' => ['/main/default/about']],
        ['label' => 'Contact', 'url' => ['/main/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/signup']];
        $menuItems[] = ['label' => 'Вход', 'url' => ['/login']];
    } else {
        $menuItems[] = [
            'label' => Yii::$app->user->identity->username, 'items' => [
                ['label' => 'Профиль', 'url' => ['/profile?id=' . Yii::$app->user->identity->id]],
                //['label' => 'Соцсети', 'url' => ['/user/settings/networks?id=' . Yii::$app->user->identity->id]],
                ['label' => '', 'options' => ['role' => 'presentation', 'class' => 'divider']],
                ['label' => 'Выход', 'url' => ['/logout'], 'linkOptions' => ['data-method' => 'post']],
            ],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

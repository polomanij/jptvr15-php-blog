<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use \app\assets\PublicAssets;
use app\models\Article;
use app\models\Category;
use app\models\Tag;

PublicAssets::register($this);

$popularArticles = Article::find()->limit(5)->all();
$categories = Category::find()->all();
$tags = Tag::find()->all();
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <header class="header">
        <div class="wrapper">
            <div class="header-row">
                <div class="header-logo">
                    <div class="header-logo-wrap"><a href="#">
                            <h1>Блог ИТ новостей</h1><img src="<?= Yii::getAlias('@web') . '/public/img/logo.png'?>" alt="logo"/></a></div>
                </div>
                <menu class="header-menu">
                    <div class="header-menu-toggle"><a>Меню</a></div>
                    <ul>
                        <li><a href="index">Главная</a></li>
                        <li><a href="author">Автор</a></li>
                        <li><a href="login">Вход</a></li>
                        <li><a href="registration.html">Регистрация</a></li>
                    </ul>
                </menu>
            </div>
        </div>
    </header>
    <main class="main">
        <div class="wrapper">
            <div class="main-row">
                <section class="main-content">
                    <?= $content ?>
                </section>
                <aside class="main-sidebar">
                    <div class="main-sidebar-best">
                        <h3>Самые просматриваемые статьи</h3>
                        <?php foreach($popularArticles as $article): ?>
                        <a href="<?= Url::toRoute(['site/single', 'id' => $article->id]) ?>"><?= $article->title ?></a>
                        <?php endforeach; ?>
                    </div>
                    <div class="main-sidebar-banner"><a href="#"><img src="<?= Yii::getAlias('@web') . '/public/img/banner.jpg'?>" alt=""/></a></div>
                    <div class="main-sidebar-category">
                        <h3>Категории</h3>
                        <?php foreach($categories as $category): ?>
                        <a href="#"><?= $category->title ?></a>
                        <?php endforeach; ?>
                    </div>
                    <div class="main-sidebar-tags">
                        <h3>Метки</h3>
                        <?php foreach($tags as $tag): ?>
                        <a href="#"><?= $tag->title ?></a>
                        <?php endforeach; ?>
                    </div>
                    <div class="main-sidebar-banner"><a href="#"><img src="<?= Yii::getAlias('@web') . '/public/img/banner.jpg'?>" alt=""/></a></div>
                </aside>
            </div>
        </div>
    </main>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

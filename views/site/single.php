<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Single';
$this->params['breadcrumbs'][] = $this->title;
?>
<h2 class="content-title"><?= $article->title ?></h2>
<div class="content-post">
    <?php 
        if (!empty($article->image)) {
            echo '<div class="content-post-img"><img src="' . Yii::getAlias('@web') . '/uploads/' . $article->image . '" alt=""/></div>';
        }
    ?>
    <p><?= $article->text ?></p>
    <div class="content-post-info">
        <div class="content-post-category">
            <p>Категория:</p><a href="#"><?= $article->category->title ?></a>
        </div>
        <div class="content-post-tags">
            <p>Метки:</p><a href="#">Плагины</a><a href="#">Софт</a>
        </div><i class="fas fa-eye"></i><span> <?= $article->viewed ?></span>
    </div>
</div>
<div class="comments">
    <h2 class="content-title">Комментарии</h2>
    <form action="post" class="comments-add">
        <p>Оставить комментарий:</p>
        <textarea name="comment" class="comments-new"></textarea>
        <input type="submit" class="submit-btn"/>
    </form>
    <div class="comments-item">
        <h3 class="comments-item-name">Олег:</h3>
        <p class="comments-item-text">Очень интересная статья</p>
    </div>
    <div class="comments-item">
        <h3 class="comments-item-name">Олег:</h3>
        <p class="comments-item-text">Понравилось, спасибо!</p>
    </div>
    <div class="comments-item">
        <h3 class="comments-item-name">Олег:</h3>
        <p class="comments-item-text">Понравилось, спасибо!</p>
    </div>
</div>
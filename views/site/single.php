<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Single';
$this->params['breadcrumbs'][] = $this->title;

$tags = $article->tags
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
                <p>Категория:</p><a href="<?= Url::toRoute(['site/index', 'category_id' => $article->category->id]) ?>"><?= $article->category->title ?></a>
            </div>
            <div class="content-post-tags">
                <p>Метки:</p>
                <?php foreach ($tags as $tag): ?>
                    <a href="<?= Url::toRoute(['site/index', 'tag_id' => $tag->id]) ?>"><?= $tag->title ?></a>
                <?php endforeach; ?>
        </div><i class="fas fa-eye"></i><span> <?= $article->viewed ?></span>
    </div>
</div>
<div class="comments">
    <h2 class="content-title">Комментарии</h2>
    <?php if (!Yii::$app->user->isGuest): ?>
        <?php $form = \yii\widgets\ActiveForm::begin([
            'action' => ['site/comment', 'id' => $article->id],
            'options' => ['class' => 'comments-add']
        ]); ?>
            <?= $form->field($commentForm, 'comment')->textarea(['class' => 'comments-new'])->label('Оставить комментарий:') ?>
        <input type="submit" class="submit-btn" value="Оставить комментарий"/>
        <?php \yii\widgets\ActiveForm::end(); ?>
    <?php endif; ?>
    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
        <?php if (!$comment->blocked): ?>
            <div class="comments-item">
                <h3 class="comments-item-name"><?= $comment->user->name ?>:</h3>
                <p class="comments-item-text"><?= $comment->text ?></p>
            </div>
        <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="comments-item-text">Пока нет ни одного комментария</p>
    <?php endif; ?>
</div>
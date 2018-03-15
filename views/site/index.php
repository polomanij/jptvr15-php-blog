<?php
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Home';
?>
<h2 class="content-title">Публикации</h2>
<?php foreach ($articles as $article): ?>
<div class="content-post">
    <h3 class="content-post-title"><?= $article->title ?></h3>
    <?php 
        if (!empty($article->image)) {
            echo '<div class="content-post-img"><img src="' . Yii::getAlias('@web') . '/uploads/' . $article->image . '" alt=""/></div>';
        }
    ?>
    <p><?= $article->desc ?></p>
    <div class="content-post-info">
        <div class="content-post-category">
            <p>Категория:</p><a href="#"><?= $article->category->title ?></a>
        </div>
        <div class="content-post-tags">
            <p>Метки:</p><a href="#">Плагины</a><a href="#">Софт</a>
        </div><a href="<?= Url::toRoute(['site/single', 'id' => $article->id]) ?>" class="content-post-read">Read more</a><i class="fas fa-eye"></i><span> <?= $article->viewed ?></span>
    </div>
</div>
<?php endforeach; ?>
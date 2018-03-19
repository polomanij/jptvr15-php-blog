<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $article \app\models\Article */

$this->title = 'Home';
?>
<h2 class="content-title">Публикации</h2>
<?php foreach ($articles as  $article): ?>
    <?php $tags = $article->tags ?>
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
                <p>Категория:</p><a href="<?= Url::toRoute(['site/index', 'category_id' => $article->category->id]) ?>"><?= $article->category->title ?></a>
            </div>
            <div class="content-post-tags">
                <p>Метки:</p>
                <?php foreach ($tags as $tag): ?>
                    <a href="<?= Url::toRoute(['site/index', 'tag_id' => $tag->id]) ?>"><?= $tag->title ?></a>
                <?php endforeach; ?>
            </div><a href="<?= Url::toRoute(['site/single', 'id' => $article->id]) ?>" class="content-post-read">Read more</a><i class="fas fa-eye"></i><span> <?= $article->viewed ?></span>
        </div>
    </div>
<?php endforeach; ?>
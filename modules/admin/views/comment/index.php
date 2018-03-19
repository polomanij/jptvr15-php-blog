<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Text</th>
            <th>Action</th>
        </tr>
        <?php foreach ($comments as $comment): ?>
            <tr>
                <td><?= $comment->id ?></td>
                <td><?= $comment->user->name ?></td>
                <td><?= $comment->text ?></td>
                <td>
                    <a class="btn btn-danger" href="<?= Url::toRoute(['comment/delete', 'id' => $comment->id]) ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</div>

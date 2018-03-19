<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Comment;

class CommentForm extends Model
{
    public $comment;
    
    public function rules()
    {
        return [
            [['comment'], 'required'],
        ];
    }
    
    public function saveComment($article_id)
    {
        $comment = new Comment;
        
        $comment->text = $this->comment;
        $comment->article_id = $article_id;
        $comment->user_id = Yii::$app->user->id;
        
        return $comment->save();
    }
}

<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\models\Comment;

class CommentController extends Controller
{
    public function actionIndex()
    {
        $comments = Comment::find()->orderBy('id desc')->all();
        
        return $this->render('index', ['comments' => $comments]);
    }
    
    public function actionDelete($id)
    {
        $comment = Comment::findOne($id);
        
        $comment->delete();
        
        return $this->redirect(['comment/index']);
    }
}

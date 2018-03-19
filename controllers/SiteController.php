<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use \app\models\Article;
use yii\data\Pagination;
use app\models\Tag;
use app\models\SignupForm;
use \app\models\CommentForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($category_id = null, $tag_id = null)
    {
        $query = Article::find();
        
        $articleCount = $query->count();
        
        if (!empty($category_id)) {
            $articles = Article::getArticlesByCategoryId($category_id);
        } elseif (!empty ($tag_id)) {
            $tag = new Tag;
            $tag->id = $tag_id;
            $articles = $tag->articles;
        } else {
            $articles = $query->orderBy('date')->all();
        }
        
        return $this->render('index', [
            'articles' => $articles,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionSingle($id)
    {
        $article = Article::findOne($id);
        $comments = $article->comments;
        $commentForm = new CommentForm();
        
        $article->viewedCount();
        
        return $this->render('single', [
            'article' => $article,
            'comments' => $comments,
            'commentForm' => $commentForm
        ]);
    }
    
    public function actionAuthor()
    {
        return $this->render('author');
    }
    
    public function actionSignup()
    {
        $model = new SignupForm;
        
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            
            if ($model->signup()) {
                return $this->redirect(['site/login']);
            }
        }
        
        return $this->render('signup', ['model' => $model]);
    }
    
    public function actionComment($id)
    {
        $model = new CommentForm();
        
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            
            if ($model->saveComment($id)) {
                return $this->redirect(['site/single', 'id' => $id]);
            }
        }
    }
}

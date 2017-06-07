<?php

namespace app\controllers;

use app\models\AddContentForm;
use app\models\CommentForm;
use app\models\Stat;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Users;
use yii\web\UploadedFile;
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','login','signup','addcontent','articlelist'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','addcontent','articlelist'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $this->layout="corlate";

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


    public function actionBlog(){


        return $this->render('blog');

    }
    public function actionBlogitem(){
        if (Yii::$app->user->isGuest) {
            return $this->redirect('?r=site/login');
        }
        $Comment=new CommentForm();
        if($Comment->load(Yii::$app->request->post()) && $Comment->comment()){
            return $this->redirect('?r=site/blog');

        }
        return $this->render('blog-item',['Comment'=>$Comment]);



    }
    public function actionComment(){
        $tid=Yii::$app->request->get('tid');

        if (Yii::$app->user->isGuest) {
            return $this->redirect('?r=site/login');
        }
        $Comment=new CommentForm();
        if($Comment->load(Yii::$app->request->post()) && $Comment->comment()){
            return $this->redirect('?r=site/blogitem&tid='.$tid);

        }
        return $this->render('blog-item',['Comment'=>$Comment]);

    }
    public function actionSignup(){

        $model= new \app\models\SignupForm;
        if($model->load(yii::$app->request->post())&&$model->signup()){


            return $this->redirect('?r=site/upinfo');


        }
        return $this->render('signup',['model'=>$model]);

    }
    public function actionUpinfo(){

        if (Yii::$app->user->isGuest) {
            return $this->redirect('?r=site/login');
        }
        $userInfo= new \app\models\UserInfoForm;
        $UploadHeadImg= UploadedFile::getInstance($userInfo, 'UploadHeadImg');



        if($userInfo->load(yii::$app->request->post())&&$userInfo->updateUserInfo($UploadHeadImg)){

            return $this->redirect('?r=site/index');
       }

        return $this->render('UpdateUserInfo',['userInfo'=>$userInfo]);

    }
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout="corlate";
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {

        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {

        return $this->render('about');
    }
    public function actionAddcontent(){

        if (Yii::$app->user->isGuest) {
            return $this->redirect('?r=site/login');
        }
        $Article=new AddContentForm();
        if($Article->load(Yii::$app->request->post()) && $Article->addContent()){
            return $this->redirect('?r=site/blog');

        }

        return$this->render("addcontent",['Article'=>$Article]);
    }
    public function actionUpdatecontent(){

        if (Yii::$app->user->isGuest) {
            return $this->redirect('?r=site/login');
        }
        $Article=new AddContentForm();
        if($Article->load(Yii::$app->request->post()) && $Article->addContent()){
            return $this->redirect('?r=site/blog');

        }

        return$this->render("updatecontent",['Article'=>$Article]);
    }
    public function actionArticlelist(){
        return $this->render("articleList");
    }



}
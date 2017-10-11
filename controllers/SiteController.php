<?php
/**
 * This file is part of the yiiForBlog.
 * @link http://weplay.ubadbad.cc/
 * @copyright Copyright (c) 2017 v-sir studio.
 */

namespace app\controllers;

use app\models\AddContentForm;
use app\models\CommentForm;
use Yii;
use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\web\ServerErrorHttpException;
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
                'only' => ['logout', 'login', 'signup', 'addcontent', 'articlelist'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'signup'],
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'addcontent', 'articlelist'],
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
        $this->layout = "corlate";

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


    public function actionBlog()
    {


        return $this->render('blog');

    }

    public function actionBlogitem()
    {

        $Comment = new CommentForm();
        if ($Comment->load(Yii::$app->request->post()) && $Comment->comment()) {
            return $this->redirect('?r=site/blog');

        }
        return $this->render('blog-item', ['Comment' => $Comment]);


    }

    public function actionComment()
    {
        $tid = Yii::$app->request->get('tid');
        $user_id = Yii::$app->request->get('user_id');

        if (Yii::$app->user->isGuest) {
            return $this->redirect('?r=site/login');
        }


        $Comment = new CommentForm();
        if ($Comment->load(Yii::$app->request->post()) && $Comment->comment()) {
            return $this->redirect('?r=site/blogitem&tid=' . $tid . "&user_id=" . $user_id);

        }
        return $this->render('blog-item', ['Comment' => $Comment]);

    }

    public function actionSignup()
    {

        $model = new \app\models\SignupForm;
        if ($model->load(yii::$app->request->post()) && $model->signup()) {


            return $this->redirect('?r=site/upinfo');


        }
        return $this->render('signup', ['model' => $model]);

    }

    public function actionUpinfo()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect('?r=site/login');
        }
        $userInfo = new \app\models\UserInfoForm;
        $UploadHeadImg = UploadedFile::getInstance($userInfo, 'UploadHeadImg');


        if ($userInfo->load(yii::$app->request->post()) && $userInfo->updateUserInfo($UploadHeadImg)) {

            return $this->redirect('?r=site/index');
        }

        return $this->render('UpdateUserInfo', ['userInfo' => $userInfo]);

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
        $this->layout = "corlate";
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
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

    public function actionAddcontent()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect('?r=site/login');
        }
        $Article = new AddContentForm();
        if ($Article->load(Yii::$app->request->post()) && $Article->addContent()) {
            return $this->redirect('?r=site/blog');

        }

        return $this->render("addcontent", ['Article' => $Article]);
    }

    public function actionUpdatecontent()
    {

        if (Yii::$app->user->isGuest) {
            return $this->redirect('?r=site/login');
        }
        $Article = new AddContentForm();
        if ($Article->load(Yii::$app->request->post()) && $Article->addContent()) {
            return $this->redirect('?r=site/blog');

        }

        return $this->render("updatecontent", ['Article' => $Article]);
    }

    public function actionArticlelist()
    {
        return $this->render("articleList");
    }

    /**
     * WebHook 推送日志
     * @param string $branch 代码仓库分支
     * @param string $webhook 推送方式：gitHub /gitLab
     * @throws \yii\web\HttpException
     * 验证方式：GitHub：X-Hub-Signature / GitLab：HTTP_X_GITLAB_TOKEN
     */
    public function actionWebHook($branch, $webhook)
    {
        $token = '16d654e67c04904252d6266430876461';
        $data = json_decode(file_get_contents('php://input'), true);
        // github webhook
        if ($webhook === 'github') {
            list($algo, $hash) = explode('=', $_SERVER[WEBHOOK_GITHUB], 2) + ['', ''];
            if (!in_array($algo, hash_algos())) {
                // throw  new NotSupportedException($algo . ' is not Supported.');
            }
            if ($hash !== hash_hmac($algo, $data, $token)) {
                throw new ForbiddenHttpException('Access denied.');
            }
        } else {
            // gitlab webhook
            if (!isset($_SERVER[WEBHOOK_GITLAB]) || $_SERVER[WEBHOOK_GITLAB] !== $token) {
                throw new ForbiddenHttpException('Access denied.');
            }
        }
        if (!isset($data['ref'])) {
            throw new BadRequestHttpException('Bad Request.');
        }
        if (isset($data['ref']) && $data['ref'] === 'refs/heads/' . $branch) {
            exec('cd /home/www/dev-dir/yiiForBlog && git pull origin master-dev 2>&1');
        }
        $commit = $data['commits'][0];
        $repo = $data['repository']['name'];
        $basePath = Yii::getAlias('@app/runtime/' . $webhook);
        if (!is_dir($basePath) && !@mkdir($basePath, 0777, true)) {
            throw new ServerErrorHttpException('Can not create dir.');
        }
        $file = $basePath . '/' . $repo . '-' . $branch . '-push.log';
        $line = $commit['timestamp'] . "\t" . $commit['author']['name'] . "\t" . $commit['id'] . PHP_EOL;
        file_put_contents($file, $line, FILE_APPEND);
    }
}

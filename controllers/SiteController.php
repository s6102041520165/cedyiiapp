<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;
use app\models\ContactForm;
use app\components\AuthHandler;
use app\models\Photo;

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
                    'logout' => ['post'],
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
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'oAuthSuccess'],
            ],
        ];
    }

    public function oAuthSuccess($client) {
        // get user data from client
        $userAttributes = $client->getUserAttributes();

        if(empty($userAttributes['email'])){
            Yii::$app->session->setFlash('error', 'กรุณากด Allow Access ใน Facebook เพื่อใช้งาน Facebook Login');
            return $this->redirect('/site/login');
        }
        $user = User::findOne(['email' => $userAttributes['email']]);

        //Have user on system.
        if($user){
            //Check status doesn't active.
            if($user->status != User::STATUS_ACTIVE){
                $user->status = User::STATUS_ACTIVE;
                $user->save();
            }
            $login = new User();

            $login->login($user->email);
           /*Yii::$app->getUser()->login($user);  
            var_dump($user); 
            die();*/
        }
        else
        {
            //if don't have user on system.
            $uname = explode("@", $userAttributes['email']);// แยกอีเมลล์ด้วย @
            $name = explode(" ", $userAttributes['name']);
            $fname = $name[0];
            $lname = $name[1];

            $getuser = User::findOne(['email' => $userAttributes['email']]);
            
            if($getuser)
            {
                //มี username จาก username ที่ได้จาก email
                //echo 'exit user from username';
                $rand = rand(10, 99);
                $username = $uname[0].$rand;
            }
            else
            {
                $username = $uname[0];
            }

            $new_user = new User();
            $new_user->username = $username;
            $new_user->auth_key = Yii::$app->security->generateRandomString();
            $new_user->password_hash = Yii::$app->security->generatePasswordHash($username);
            $new_user->email = $userAttributes['email'];
            $new_user->fname = $fname;
            $new_user->lname = $lname;
            $new_user->picture = $userAttributes['picture'];
            $new_user->status = User::STATUS_ACTIVE;

            print_r($new_user->save());


            
            $new_user->login($new_user->email);
            
        }
        return $this->render('index');
        //exit();
        // do some thing with user data. for example with $userAttributes['email']
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
     * Displays contact page.
     *
     * @return Response|string
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
}

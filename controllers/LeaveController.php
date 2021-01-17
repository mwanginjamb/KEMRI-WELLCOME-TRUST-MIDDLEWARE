<?php

namespace app\controllers;

use app\models\Services;
use Yii;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class LeaveController extends Controller
{
    /**
     * {@inheritdoc}
     */


    public function beforeAction($action)
    {
        if (in_array($action->id , Yii::$app->params['LeaveCsrfBlock']) ) {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {

        return [


            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','images'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => Yii::$app->params['LeaveCsrfBlock'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'contentNegotiator' =>[
                'class' => ContentNegotiator::class,
                'only' => Yii::$app->params['LeaveCsrfBlock'], // Action to be asscciated with this behavior
                'formatParam' => '_format',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    //'application/xml' => Response::FORMAT_XML,
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],

            'corsFilter' => [
                'class' => \yii\filters\Cors::className(),
                'cors' => [
                    // restrict access to
                    //'Origin' => ['capacitor://localhost','http://localhost'],
                    // Allow only POST and PUT methods
                    'Access-Control-Request-Method' => ['POST', 'PUT', 'GET'],
                    // Allow only headers 'X-Wsse'
                    'Access-Control-Request-Headers' => ['*'],
                    // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
                    'Access-Control-Allow-Credentials' => false,
                    // Allow OPTIONS caching
                    'Access-Control-Max-Age' => 3600,
                    // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                    'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
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
    public function actionIndex()
    {
        $service = Yii::$app->params['ServiceName']['LeaveList'];
        $filter = [
            //'Employee_No' => Yii::$app->user->identity->Employee[0]->No,
        ];
        $results = \Yii::$app->navhelper->getData($service,$filter);

        return $results;
    }

    public function actionAuth()
    {
        $service = Yii::$app->params['ServiceName']['UserSetup'];
        $credentials = new \stdClass();
        $credentials->UserName = Yii::$app->params['NavisionUsername'];
        $credentials->PassWord = Yii::$app->params['NavisionPassword'];

        Yii::$app->recruitment->printrr(Yii::$app->navhelper->findOne($service,$credentials,'User_ID', Yii::$app->params['AdPrefix'].Yii::$app->params['NavisionUsername']));
    }


}

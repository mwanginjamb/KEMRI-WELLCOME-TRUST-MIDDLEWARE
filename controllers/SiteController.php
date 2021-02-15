<?php

namespace app\controllers;

use app\models\Leave;
use Yii;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
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
                        'actions' => Yii::$app->params['UnAuthorized'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'contentNegotiator' =>[
                'class' => ContentNegotiator::class,
                'only' => Yii::$app->params['MapActions'], // Action to be asscciated with this behavior
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


    /*Middleware methoods*/



    // Authentication

    public function actionAuth()
    {
        $service = Yii::$app->params['ServiceName']['UserSetup'];
        $credentials = new \stdClass();
        $json = file_get_contents('php://input');
        // Convert it into a PHP object
        $data = json_decode($json);
        $NavisionUsername = $data->Username;
        $NavisionPassword = $data->Password;

        $credentials->UserName = $NavisionUsername;
        $credentials->PassWord = $NavisionPassword;

        $result = (Yii::$app->Navhelper->findOne($service,$credentials,'User_ID', $NavisionUsername));

        return $result;
    }

    public function actionEmployee($No)
    {
        $service = Yii::$app->params['ServiceName']['Employee'];
        $result = (Yii::$app->Navhelper->findOne($service,'','No', $No));

        return $result;
    }

    public function actionList($EmployeeNo = '')
    {
        $service = Yii::$app->params['ServiceName']['LeaveList'];
        $filter = [];

        if(!empty($EmployeeNo)){
            $filter = [
                'Employee_No' => $EmployeeNo
            ];
        }
        $result = Yii::$app->navhelper->getData($service,$filter);

        return $result;
    }

    public function actionEmployees(){
        $service = Yii::$app->params['ServiceName']['Employees'];

        $employees = \Yii::$app->navhelper->getData($service);
        $data = [];
        $i = 0;
        if(is_array($employees)){

            foreach($employees as  $emp){
                $i++;
                if(!empty($emp->Full_Name) && !empty($emp->No)){
                    $data[] = [
                        'No' => $emp->No,
                        'Full_Name' => $emp->Full_Name
                    ];
                }

            }
        }

        return $data;
        // return ArrayHelper::map($data,'No','Full_Name');
    }

    public function actionLeaveTypes($gender = ''){
        $service = Yii::$app->params['ServiceName']['LeaveTypesSetup']; //['leaveTypes'];
        $filter = [];

        $arr = [];
        $i = 0;
        $result = \Yii::$app->navhelper->getData($service,$filter);
        foreach($result as $res)
        {
            if($res->Gender == 'Both' || $res->Gender == $gender )
            {
                ++$i;
                $arr[] = [
                    'Code' => $res->Code,
                    'Description' => $res->Description
                ];
            }
        }

        return $arr;
        //return ArrayHelper::map($arr,'Code','Description');
    }



    public function actionLeave()
    {
        $service = Yii::$app->params['ServiceName']['LeaveCard'];
        $model = new Leave();
        // Takes raw data from the request
        $json = file_get_contents('php://input');
        // Convert it into a PHP object
        $data = json_decode($json);
        // Get Record to Update

        $refresh = Yii::$app->Navhelper->getData($service, ['Application_No' => $data->Weighment_No]);

        //Load model with Line Data
        if(!is_string($refresh)){ // Array of Object Was Returned

            $model = Yii::$app->Navhelper->loadmodel($data,$model);
            $model->Key = $refresh[0]->Key;

            // Do actual update
            $update = Yii::$app->Navhelper->updateData($service, $model);
            return $update;
        }else{ // Return Navision Error
            return $refresh;
        }

    }





    /*End Middleware methods*/













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

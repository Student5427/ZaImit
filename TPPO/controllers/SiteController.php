<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use app\models\Workers;
use app\models\Clients;

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
                'only' => ['logout', 'clients', 'profile'],
                'rules' => [
                    [
                        'actions' => ['logout', 'clients', 'profile'],
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
        ];
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
            return $this->goBack();
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


    public function actionClients()
    {
        $pagination = new Pagination(['defaultPageSize'=>10]);
        $dataProvider = new ActiveDataProvider(['query' => Clients::find(), 'pagination' => $pagination]);
        return $this->render('clients', ['dataProvider'=>$dataProvider]);
    }

    public function actionUpdate($id)
	{
		$client = Clients::findOne($id);
		if ($client->load(Yii::$app->request->post())) {
		$client->save();
            		return $this->redirect('index.php?r=site%2Fclients');
        	}
		return $this->render('updateClient', compact('client'));
	}

    public function actionAdd_client()
    {
        $client = new Clients();
        if ($client->load(Yii::$app->request->post())) {
            $client->save();
             return $this->redirect('index.php?r=site%2Fclients');
            }
        return $this->render('updateClient', ['client'=>$client]);
    }

    public function actionDelete($id)
    {
        $client = Clients::findOne($id);
        if ($client)
        {
            $client->delete();
            return $this->redirect('index.php?r=site%2Fclients');
        }

    }

    public function actionProfile(){
        $user = Yii::$app->user->identity;
        return $this->render('profile', ['data' => $user]);
    }
}



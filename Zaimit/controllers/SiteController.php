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
use app\models\TblInfReg;
use app\models\TblLoan;
use app\models\TblPay;
use app\models\TblRegist;

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
                        'actions' => ['logout', 'clients', 'profile', 'inf_Reg', 'add_Client', 'update', 'delete', 'profile'],
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

    public function actionInf_reg()
    {
        $pagination = new Pagination(['defaultPageSize'=>10]);
        $dataProvider = new ActiveDataProvider(['query' => TblInfReg::find(), 'pagination' => $pagination]);
        return $this->render('TblInfReg', ['dataProvider'=>$dataProvider]);
        
    }
    
    public function actionRegistrations()
    {
        $pagination = new Pagination(['defaultPageSize'=>10]);
        $dataProvider = new ActiveDataProvider(['query' => TblRegist::find(), 'pagination' => $pagination]);
        return $this->render('TblRegist', ['dataProvider'=>$dataProvider]);
        
    }

    public function actionClients()
    {
        $pagination = new Pagination(['defaultPageSize'=>10]);
        $dataProvider = new ActiveDataProvider(['query' => Clients::find(), 'pagination' => $pagination]);
        return $this->render('clients', ['dataProvider'=>$dataProvider]);
    }

    public function actionView($id)
    {
        $client = Clients::findOne($id);
        $pagination = new Pagination(['defaultPageSize'=>10]);
        $dataProvider = new ActiveDataProvider(['query' => TblLoan::find()->where(['id_client'=>$id]), 'pagination' => $pagination]);
        return $this->render('client_loan', ['dataProvider'=>$dataProvider, 'client'=>$client]);
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
	
	public function actionUpdate_regist($id)
	{
		$client = Clients::findOne($id);
		if ($client->load(Yii::$app->request->post())) {
		$client->save();
            		return $this->redirect('index.php?r=site%2Fclients');
        	}
		return $this->render('updateClient', compact('client'));
	}
	
	public function actionCancel_regist($id)
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

    public function actionAdd_loan($id)
    {
        $loan = new TblLoan();
        $client = Clients::findOne($id);
        if ($loan->load(Yii::$app->request->post())) {
            $loan->id_worker = Yii::$app->user->identity->id_worker;
            $loan->id_client = $id;
            $loan->save();
             return $this->redirect('index.php?r=site%2Fclients');
            }
        return $this->render('updateTblLoan', ['model'=>$loan]);
    }

    public function actionAdd_pay($id)
    {
        $loan = TblLoan::find()->where(['id_loan'=>$id])->one();
        $pay = new TblPay();
        $client = Clients::findOne($id);
        if ($pay->load(Yii::$app->request->post())) {
            $pay->id_loan = $id;
            $pay->save();
            $loan->loan_sum_pay += $pay->pay_sum;
            $loan->save();
             return $this->redirect('index.php?r=site%2Fclients');
            }
        return $this->render('updateTblPay', ['model'=>$pay]);
    }

    public function actionCheck_pays($id)
    {
        $loan = TblLoan::findOne($id);
        $pagination = new Pagination(['defaultPageSize'=>10]);
        $dataProvider = new ActiveDataProvider(['query' => TblPay::find()->where(['id_loan'=>$id]), 'pagination' => $pagination]);
        return $this->render('loan_pays', ['dataProvider'=>$dataProvider, 'loan'=>$loan]);
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



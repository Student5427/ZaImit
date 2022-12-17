<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use app\models\TblWorker;
use app\models\User;

class AdminController extends Controller {


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

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'matchCallback' => function($rule, $action){
                            $access = FALSE;
                            if (!Yii::$app->user->isGuest){
                                $user = Yii::$app->user->identity;
                                $worker = $user->getWorker();
                                if (Yii::$app->user->identity->isAdmin()){
                                    $access = TRUE;
                                }
                            }
                            return $access;
                        },
                    ],
                ],
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
        return $this->render('index', ['data'=> Yii::$app->user->identity]);
    }

    public function actionWorkers()
    {
        $pagination = new Pagination(['defaultPageSize'=>10]);
        $dataProvider = new ActiveDataProvider(['query' => TblWorker::find(), 'pagination' => $pagination]);
        return $this->render('workers', ['dataProvider'=>$dataProvider]);
    }

    public function actionUpdate($id)
	{
		$worker = TblWorker::findOne($id);
		if ($worker->load(Yii::$app->request->post())) {
		$worker->save();
            		return $this->redirect('index.php?r=admin%2Fworkers');
        	}
		return $this->render('updateWorker', compact('worker'));
	}

    public function actionAdd_worker()
    {
        $worker = new TblWorker();
        if ($worker->load(Yii::$app->request->post())) {
            $worker->worker_countm = 0;
            $worker->save();
             return $this->redirect('index.php?r=admin%2Fworkers');
            }
        return $this->render('updateWorker', ['worker'=>$worker]);
    }

    public function actionDelete($id)
    {
        $worker = TblWorker::findOne($id);
        if ($worker)
        {
            $auth = User::find()->where(['id_worker'=>$id])->one();
            $worker->delete();
            $auth->delete();
            return $this->redirect('index.php?r=admin%2Fworkers');
        }

    }
    
    public function actionAuth($id)
	{
	    if ( User::find()->where(['id_worker'=>$id])->one())
	    {
	        $auth = User::find()->where(['id_worker'=>$id])->one();
	    }
	    else
	    {
	        $auth = new User();
	    }
	    if ($auth->load(Yii::$app->request->post())) {
            $auth->id_worker = $id;
            if (User::find()->where(['auth_login'=>$auth->auth_login])->andWhere(['!=','id_worker',$id])->one()) {
                return $this->render('error', ['name'=>'Дубликация данных','message'=>'Такой логин уже есть в БД!']);
            }
            $auth->save();
             return $this->redirect('index.php?r=admin%2Fworkers');
            }
	    return $this->render('auth', ['auth'=>$auth]);
		/*$worker = TblWorker::findOne($id);
		if ($worker->load(Yii::$app->request->post())) {
		$worker->save();
            		return $this->redirect('index.php?r=admin%2Fworkers');
        	}
		return $this->render('auth', compact('auth'));*/
	}
    
}

?>
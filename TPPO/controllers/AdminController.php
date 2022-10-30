<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use app\models\Workers;

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
                                if ($worker->role == "admin"){
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
        $dataProvider = new ActiveDataProvider(['query' => Workers::find(), 'pagination' => $pagination]);
        return $this->render('workers', ['dataProvider'=>$dataProvider]);
    }

    public function actionUpdate($id)
	{
		$worker = Workers::findOne($id);
		if ($worker->load(Yii::$app->request->post())) {
		$worker->save();
            		return $this->redirect('index.php?r=admin%2Fworkers');
        	}
		return $this->render('updateWorker', compact('worker'));
	}

    public function actionAdd_worker()
    {
        $worker = new Workers();
        if ($worker->load(Yii::$app->request->post())) {
            $worker->save();
             return $this->redirect('index.php?r=admin%2Fworkers');
            }
        return $this->render('updateWorker', ['worker'=>$worker]);
    }

    public function actionDelete($id)
    {
        $worker = Workers::findOne($id);
        if ($worker)
        {
            $worker->delete();
            return $this->redirect('index.php?r=admin%2Fworkers');
        }

    }

}

?>
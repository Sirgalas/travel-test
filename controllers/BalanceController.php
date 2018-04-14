<?php

namespace app\controllers;

use app\entities\Payer;
use app\entities\Transaction;
use app\forms\ToUserForm;
use SebastianBergmann\Timer\RuntimeException;
use Yii;
use app\entities\Balance;
use app\search\BalanceSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\entities\User;
use app\services\BalanceService;
/**
 * BalanceController implements the CRUD actions for Balance model.
 */
class BalanceController extends Controller
{

    private $service;

    public function __construct($id, $module, BalanceService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);

    }
    
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Balance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BalanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Balance model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    

    /**
     * Deletes an existing Balance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionTransactionAdd(){
        $model=new Transaction();
        $payer= ArrayHelper::map(Payer::find()->asArray()->all(),'id','payer_name');
        $model->balance_id=Yii::$app->user->identity->balance->id;
        if($model->load(Yii::$app->request->post())){
            try{
                if(!$model->save())
                    throw new \RuntimeException('Transaction not valid');
                return $this->redirect(Yii::$app->homeUrl);
            }catch (\RuntimeException $e){
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('add-transaction',[
            'model'=>$model,
            'payer'=>$payer
        ]);
    }

    public function actionToUser($id){
        $model = $this->findModel($id);
        $form = new ToUserForm();
        $users = ArrayHelper::map(User::find()->asArray()->all(),'id','login');
        if($form->load(Yii::$app->request->post())){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                $this->service->toUser($form,$id);
                $transaction->commit();
                return $this->redirect(Yii::$app->homeUrl);
            }catch (\Exception $e){
                Yii::$app->session->setFlash('error', $e->getMessage());
                $transaction->rollBack();
            }
        }
        return $this->render('to-user',[
            'users'=>$users,
            'model'=>$model,
            'toUserForm'=>$form
        ]);
    }

    /**
     * Finds the Balance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Balance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Balance::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

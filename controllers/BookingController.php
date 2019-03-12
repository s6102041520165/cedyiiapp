<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Guest;
use app\models\Diet;
use app\models\OrdersList;
use yii\db\Query;
use app\models\Payment;
use yii\helpers\Url;
use app\models\Orders;
use yii\helpers\Security;
use yii\web\IdentityInterface;
use \app\models\Bank;
use yii\web\NotFoundHttpException;


class BookingController extends Controller 
{
    /**
     * {@inheritdoc}
     */
    public function actionStep1()
    {
        $model = new OrdersList();
        $updateList = new OrdersList();
        $orders = new Orders();
        $request = Yii::$app->request;
        $insertid = null;
        if(isset(Yii::$app->request->post('OrdersList')['counter'])){
            $orders->userID = Yii::$app->user->identity->userID;
            $orders->counter = Yii::$app->request->post('OrdersList')['counter'];
            $orders->status = 0;

            if($orders->counter==10){
                $orders->price = 3000;
            } else {
                $orders->price = 320 * $orders->counter;
            }
            
           if($orders->save()){
                $insertid->orderID;
           }
        }

        $a=0;
        if ($model->load(Yii::$app->request->post())) {
            for($i=0; $i<10; $i++){
                foreach ($model as $key => $value) {
                    $updateList->orderID = $insertid;

                    if($model->$key[$i] && $key!=null){
                        $data[$key][] =  $model->$key[$i];
                    }
                }                
            }      
        }
        if($data){
            for($i=0; $i<count($data['fname']); $i++){
                foreach ($data as $key => $value) {
                    $updateList->$key = $data[$key][$i];

                }
                $updateList->orderID = $orders->orderID;
                Yii::$app->db->createCommand()->batchInsert('orders_list', ['orderID', 'fname','lname','tel','dietRow','dietCol'], [
                    [
                        $updateList->orderID,
                        $updateList->fname,
                        $updateList->lname,
                        $updateList->tel,
                        $data['dietRow'][0],
                        $data['dietCol'][0],
                    ],
                ])->execute();
            }
            return $this->redirect(['success','id'=> $orders->orderID]);
            
        }
        if (Yii::$app->request->post()) {
            $row = Yii::$app->request->post('row');
            $col = Yii::$app->request->post('col');
            $max = Yii::$app->request->post('max');
        }
        if(Yii::$app->request->post('numOfPeople')){
            $numOfPeople = Yii::$app->request->post('numOfPeople');
        } else $numOfPeople = 1;
        return $this->render('step1',['model' =>$model,'row'=>$row,'col'=>$col,'max'=>$max,'numOfPeople'=>$numOfPeople]);
    } 

    public function actionIndex(){
        $Diet = new Diet();
        $getDietRow = Diet::find()
                ->select('dietRow')
                ->groupBy('dietRow')
                ->all();

        $getDietCol = Diet::find()
                ->all();

        $NumBooking = OrdersList::find()
            ->select('COUNT(detailID) AS cnt,dietRow,dietCol')
            ->groupBy(['dietRow','dietCol'])
            ->all();
        //var_dump($model->load(Yii::$app->request->get()));
                
        return $this->render('index',
        [
            'Diet'=>$Diet,
            'RowDiet'=>$getDietRow,
            'NumBooking'=>$NumBooking,
            'ColDiet'=>$getDietCol,
        ]);
    }

    /***
     * 
     * 
     * Action for payment.
     * 
     * * */
    public function actionPayment()
    {
        $model = new Payment();
        $Orders = new Orders();

       
        $orderShow = null;
        if(Yii::$app->request->get('id')){
            $orderID = Yii::$app->request->get('id');
            if(!($orderShow = Orders::find()->where(['orderID'=>$orderID,'userID'=>Yii::$app->user->identity->userID])->one() ))
                throw new NotFoundHttpException('The requested page does not exist.');
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->attach = $model->upload($model,'attach');
            $chkOrders = $Orders->find()->where(['orderID' => $model->orderID])->andwhere(['userID'=>Yii::$app->user->identity->userID])->one();
            if(!empty($chkOrders->orderID)){
                $model->save();
                return $this->redirect(Url::toRoute('/orders'));
            } else {
                $model->addError('orderID', 'ไม่พบประวัติการจองของคุณ');
            }
        }

        return $this->render('payment', [
            'model' => $model,
            'orderShow' => $orderShow,
        ]);
    }

    public function actionSuccess($id)
    {
        $model = Bank::find()->one();
        $order = Orders::findOne($id);
        return $this->render('success', [
            'model' => $model,
            'order'=>$order,
        ]);
    }

    
}

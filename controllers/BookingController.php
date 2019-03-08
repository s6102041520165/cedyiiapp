<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Guest;
use app\models\Diet;
use app\models\Orders;
use yii\db\Query;


class BookingController extends Controller 
{
    /**
     * {@inheritdoc}
     */

    public function actionStep1()
    {
        $model = new Orders();
        $request = Yii::$app->request;
        if ($model->load(Yii::$app->request->post())) {
            foreach ($request->post('Booking') as $key => $value) {
                $model->$key=$value;
            }            
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

        $NumBooking = Orders::find()
            ->select('COUNT(orderID) AS cnt,dietRow,dietCol')
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
    
}

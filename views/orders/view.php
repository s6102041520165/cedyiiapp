<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
$this->title = "ประวัติการจอง : ".$model->orderID;

?>
<div class="orders-view">
    <p>
        <?php if($modelPay->orderID && (Yii::$app->user->identity->role==3 || Yii::$app->user->identity->role==2)): ?>
            <?php if($model->status==0) : ?>
                <?= Html::a('อนุญาต', ['active', 'id' => $model->orderID], [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'confirm' => 'ต้องการยืนยันประวัติการจองใช่หรือไม่?',
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif; ?>

            <?php if($model->status==1) : ?>
                <?= Html::a('ไม่อนุญาต', ['unactive', 'id' => $model->orderID], [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'confirm' => 'ต้องการยกเลินประวัติการจองใช่หรือไม่?',
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif; ?>
        <?php endif; ?>


        <?php if(Yii::$app->user->identity->role==3 || Yii::$app->user->identity->role==2): ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->orderID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'คุณต้องการลบประวัติการจองออกจากระบบหรือไม่?',
                'method' => 'post',
            ],
        ]) ?>
        <?php endif; ?>
    </p>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <?php if($model->status==1): ?>
            <h3>Qr Code สำหรับการเช็คอินภายในงาน</h3>
            <div class="alert alert-warning">กรุณาดาวน์โหลด Qr Code นี้ไว้เพื่อเช็คอินก่อนเข้างาน</div>
                <?= Html::a('ดาวน์โหลด', ['download', 'id' => $model->orderID], [
                    'class' => 'btn btn-success',
                    'data' => [
                        'confirm' => 'ต้องการดาวน์โหลด QR Code นี้ใช่หรือไม่',
                        'method' => 'post',
                    ],
                ]) ?>
            <div>
                <img  style="width:100%" src="<?=Yii::$app->request->BaseUrl."/img/".md5($model->orderID).".jpg";?>" alt="">
            </div>  
            <?php endif; ?>
            <?php if($model->status==0): ?>
            <div class="alert alert-danger">กำลังตรวจสอบข้อมูลของท่าน!</div>
            <?php endif; ?>
        </div>
        <div class="col-lg-8">
            <?php if($model!==NULL) : ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'orderID',
                    'userID',
                    'price',
                    'dateBooking',
                ],
            ]) ?>
            <?php endif; ?>
            <?php if($modelPay!==NULL) : ?>
            <?= DetailView::widget([
                'model' => $modelPay,
                'attributes' => [
                    'fname',
                    'lname',
                    'amount',
                    [
                        'attribute'=>'attach',
                        'value'=>'@web/'.$modelPay->attach, // WEB ACCESSABLE PATH + FILENAME 
                        'format' => ['image',['width'=>'400']],
                    ]
                ],
            ]) ?>
            <?php endif; ?>
            
            <?php if($OrdersList!==NULL) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="2" style="text-align:center">คุณและเพื่อน</th>
                        </tr>
                        <tr>
                            <th>โต๊ะ</th>
                            <th>ชื่อ - สกุล</th>
                            <th>เบอร์โทร</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($OrdersList as $key => $value) : ?>
                        <tr>
			    <td><?=$OrdersList[$key]->dietRow.$OrdersList[$key]->dietCol;?></td>
                            <td>
                                <?=$OrdersList[$key]->fname;?> <?=$OrdersList[$key]->lname?>
                            </td>
                            <td>
                                <?=$OrdersList[$key]->tel;?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

</div>

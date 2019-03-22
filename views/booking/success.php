<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bank */
/* @var $form ActiveForm */
?>
<div class="booking-success">
    <div class="alert alert-warning"><b>กรุณาโอนเงิน และแจ้งชำระเงินภายใน 1 วันนับตั้งแต่จองที่นั่งสำเร็จ</b></div>
    <div class="panel panel-primary">
        <div class="panel-heading">ข้อมูลธนาคารและยอดเงินที่ต้องชำระ</div>
        <div class="panel-body">
            <p>เลขบัญชี : <?= $model->bankNum ?></p>
            <p>ชื่อบัญชี : <?= $model->nameAccount ?></p>
            <p>ธนาคาร : <?= $model->bank ?></p>
	    <div class="alert alert-success">โปรดจำรหัสการจองไว้ เพื่อนำไปแจ้งชำระเงิน</div>
            <p>รหัสการจอง : <?= $order->orderID ?></p>
            <p>ยอดเงินที่ต้องชำระ : <?= $order->price ?> บาท</p>
            <p>
                <?= Html::a('แจ้งชำระเงิน', ['payment','id'=>$order->orderID], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
    </div>
    

    
    

</div><!-- booking-success -->

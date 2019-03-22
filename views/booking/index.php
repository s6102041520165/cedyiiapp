<?php
use yii\base\View;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\db\query;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
$this->title='ผังแสดงโต๊ะ';
define("MAX_BOOKING",10);
?>

<div class="booking-index">
    <?php Pjax::begin() ?>
    <div class="body-content">
        <div class="container-fluid">
            <div class="bg-green" style="max-width:800px; height:150px;margin:auto;text-align:ceter;color:white;display:flex">
                <h1 style="text-align:center;margin: auto;">Stage</h1>
            </div>
            
            <div class="table-responsive" style="max-width:800px; padding-top:100px; margin:auto;text-align:ceter;display:flex;overflow:auto">
                                    
                <?php 
                /*
                echo "<pre>";
                print_r($NumBooking[]);
                echo "</pre>";
                */
                $color = '';
                $qty = 0;
                echo "<table class='table'>";
                foreach ($RowDiet as $keyRow => $valueRow) 
                {
                    echo "<tr align='center'>";
                        
                        foreach ($ColDiet as $keyCol => $valueCol) 
                        {
                            //echo $valueCol['dietRow'];
                            if($valueCol['dietRow']==$valueRow['dietRow'])
                            {
                                $qty = constant("MAX_BOOKING");
                                echo "<td>";
                                foreach ($NumBooking as $keyBooking => $ValBooking) {
                                    if(($ValBooking['dietCol'] == $valueCol['dietCol']) && $ValBooking['dietRow'] == $valueCol['dietRow'])
                                    $qty = $qty - $ValBooking['cnt'];
                                }
                                echo $valueRow['dietRow'].$valueCol['dietCol'];
                                $color = $qty==0?"btn-danger disabled":"btn-primary";
                                echo  Html::a($qty, 
                                        ['/booking/step1'], [
                                        'data-method' => 'POST',
                                        'data-params' => [
                                            'row' => $valueCol['dietRow'],
                                            'max' => $qty,
                                            'col' => $valueCol['dietCol'],
                                        ],
                                        'class' => "btn $color btn-lg",
                                        'style' => "border-radius:50%; 
                                        margin:auto;
                                        text-align:center;
                                        max-width:50px;
                                        max-height:50px;
                                        display:flex;
                                        padding:auto"
                                    ]);
                                echo "</td>";
                            }
                            
                        }
                    echo "</tr>";
                }
                echo "</table>";
                ?>
            </div>
	  <div style="margin:auto;max-width:800px;"><hr> 
	     <h2>หมายเหตุ</h2>
	    <ul class="list-group">
		<li class="list-group-item">
                     เลือกโต๊ะที่ท่านต้องการ 
                </li>
		<li class="list-group-item">
                     <b>โปรดตัดสินใจก่อนจองโต๊ะ</b> ระบบจะลบประวัติการจองของคุณ หากไม่แจ้งชำระเงินภายใน 1 วัน 
                </li>
  		<li class="list-group-item">
		     <span class="btn btn-primary" style="border-radius:50%">10</span> 
             หมายถึง จำนวนเก้าอี้ที่เหลือ ที่ท่านสามารถจองได้
		</li>
  		<li class="list-group-item">
		     <span class="btn btn-danger" style="border-radius:50%">0</span> 
             หมายถึง โต๊ะที่มีการจองครบ <span class="label label-danger">ท่านไม่สามารถจองได้</span>
		</li>
	   </ul>
	  </div>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>

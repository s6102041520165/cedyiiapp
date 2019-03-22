<?php
use yii\base\View;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title='รายละเอียดการจอง';
?>

<div class="booking-booking">

    <div class="body-content">

        <div class="container">
            
            <table class="table table-bordered table-responsive table-striped">
                <thead>
                    <tr>
                        <th style="width:30%;text-align:center">หมายเลขโต๊ะ 
                        <?php if($row && $col): ?>
                        (<?=$row.$col?>)
                        <?php endif;?>
                        </th>
                        <td class="right" colspan="2">
                            <a class="btn btn-primary" href="<?=Url::toRoute(['booking/']);?>">เลือกที่นั่ง</a>
                        </td>
                    </tr>
                    
                    <tr>
                        <th style="width:30%;text-align:center">จำนวนที่นั่ง 
                        </th>
                        <td class="right" colspan="2">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <?php 
                                for($i=1; $i<=10; $i++):
                                    if(!($i<=$max)){
                                        $className = "disabled";
                                    } else {
                                        $className = "";
                                    }
                                    $color = ($i<10)?" btn-default":" btn-success";
                                    if($i<=$numOfPeople)$color=" btn-primary";
                                ?>
                                <?php 
                                $typeTable = NULL;
                                if($i==10)$typeTable = "(ทั้งโต๊ะ)"; ?>
                                    <?=Html::a("$i $typeTable", 
                                            ['/booking/step1'], [
                                            'data-method' => 'POST',
                                            'data-params' => [
                                                'max'=>$max,
                                                'row'=>$row,
                                                'col'=>$col,
                                                'numOfPeople'=>$i,
                                            ],
                                            'class' => "btn $className $color",
                                    ]);?>
                                <?php endfor; ?>
                            </div>
                        </td>
                    </tr>
                </thead>
            </table>

            <?php 
                $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['class' => 'form-horizontal'],
                ])
            ?>
            <?= $form->field($model, 'dietRow')->hiddenInput(['value'=>$row])->label(false); ?>
            <?= $form->field($model, 'dietCol')->hiddenInput(['value'=>$col])->label(false); ?>
            <?= $form->field($model, 'counter')->hiddenInput(['value'=>$numOfPeople])->label(false); ?>
	    <div class="alert alert-info">ใส่หรือไม่ใส่ชื่อ - สกุล และเบอร์โทรก็ได้</div>
            <table class="table table-bordered table-responsive table-striped">

                <?php for($i=1; $i<=$numOfPeople; $i++): ?>
                <tr>
                    <th style="width:30%;text-align:center"><?="(".$i.")"?> ชื่อ - สกุล</th>
                    <td align="left">
                        <div class="container-fluid">
                            <?= $form->field($model, 'fname[]', 
                                ['enableLabel' => false,
                                'inputOptions'=>['autocomplete'=>'off','placeholder'=>'ชื่อ',],
                                ]
                            ) ?>
                        </div>
                    </td>
                    <td>
                        <div class="container-fluid">
                            <?= $form->field($model, 'lname[]', 
                            ['enableLabel' => false,
                                'inputOptions'=>['autocomplete'=>'off','placeholder'=>'นามสกุล',],
                            ]
                            ) ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th style="width:30%;text-align:center">เบอร์โทร</th>
                    <td colspan="2">
                        <div class="container-fluid">
                            <?= $form->field($model, 'tel[]', 
                            ['enableLabel' => false,
                            'inputOptions'=>['autocomplete'=>'off','placeholder'=>'เบอร์โทรศัพท์',]
                            ]
                            ) ?>
                        </div>
                    </td>
                </tr>
                <?php endfor; ?>
            </table>

            <div class="row">
                <button type="submit" class="btn btn-success btn-lg">บันทึกข้อมูล</button>
            </div>

            <?php 
                ActiveForm::end();
            ?>
        </div>


    </div>
</div>

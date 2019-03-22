<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use dosamigos\datepicker\DatePicker;
use Da\QrCode\QrCode;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['breadcrumbs'][] = $this->title;
$this->title = 'บัตรเข้างาน';
?>
<div class="orders-index">

    <?php Pjax::begin(); ?>
    <?php /*echo $this->render('_search', ['model' => $searchModel]);*/ ?>
    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'orderID',
            [
                'attribute' => 'orderID',
                'value' => 'orderID'
            ],
	    [
		'attribute' => 'user.email',
		'value' => 'user.email'
	    ],
            [
                'attribute' => 'dateBooking',
                'filter'=> DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'dateBooking',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd'
                        ]
                ]),
            ],
            'price',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions'=>['class'=>'btn btn-primary'],
                'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> 
                    {view} 
                </div>'    
            ],
        ],
    ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>

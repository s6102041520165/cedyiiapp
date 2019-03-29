<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
\yii\web\YiiAsset::register($this);
$this->title = "เช็คอิน : ".$model->orderID;

?>
<div class="orders-view">
    <?=$model->orderID?>
</div>

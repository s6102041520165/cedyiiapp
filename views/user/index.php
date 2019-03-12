<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ผู้ใช้';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php Pjax::begin(); ?>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'username',
                'status',
                'fname',
                'lname' ,
                'role',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'buttonOptions'=>['class'=>'btn btn-primary'],
                    'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {view} {update} </div>'    
                ],
            ],
        ]) ?>
    </div>
    <?php Pjax::end(); ?>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DietSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Diets';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diet-index">

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Diet', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <ul class="list-group">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => function ($model, $key, $index, $widget) {
                    return Html::a(Html::encode($model->dietRow.$model->dietCol), 
                        ['view', 'dietRow' => $model->dietRow, 'dietCol' => $model->dietCol],
                    );
                },
                'itemOptions' => ['class' => 'list-group-item'],
            ]) ?>
    </ul>
    <?php Pjax::end(); ?>
</div>

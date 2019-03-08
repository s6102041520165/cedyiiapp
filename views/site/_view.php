<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

?>
<h2><?= Html::encode($model->date . ' : ' . $model->title) ?></h2>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'date',
        'title',
        'body',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ],
]) ?>
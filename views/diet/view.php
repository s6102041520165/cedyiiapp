<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Diet */

$this->title = $model->dietRow;
$this->params['breadcrumbs'][] = ['label' => 'Diets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="diet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'dietRow' => $model->dietRow, 'dietCol' => $model->dietCol], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'dietRow' => $model->dietRow, 'dietCol' => $model->dietCol], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'dietRow',
            'dietCol',
        ],
    ]) ?>

</div>

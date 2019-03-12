<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Diet */

$this->title = 'Update Diet: ' . $model->dietRow;
$this->params['breadcrumbs'][] = ['label' => 'Diets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dietRow, 'url' => ['view', 'dietRow' => $model->dietRow, 'dietCol' => $model->dietCol]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="diet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

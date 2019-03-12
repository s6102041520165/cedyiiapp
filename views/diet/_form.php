<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Diet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="diet-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dietRow')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dietCol')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

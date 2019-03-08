<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>ComEdu</b> Homecoming</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">เข้าสู่ระบบบัญชีของท่าน <br/> หรือเข้าสู่ระบบด้วย Social Media</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <div class="row">
            <!-- /.col -->
            <div class="col-lg-12">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>
        <hr/>
        <div class="d-inline mx-auto">
        
        <?php $authAuthChoice = AuthChoice::begin([
                'baseAuthUrl' => ['site/auth']
            ]); ?>

            <?php foreach ($authAuthChoice->getClients() as $client): ?>
                <?php
                switch ($client->getName()){
                    case 'facebook':
                        $class = 'primary';
                        break;
                    case 'twitter':
                        $class = 'info';
                        break;
                    case 'google':
                        $class = 'danger';
                        break;
                    case 'live':
                        $class = 'warning';
                        break;

                }

                echo $authAuthChoice->clientLink($client, 'Login with '.ucfirst($client->getName()), ['class' => 'btn btn-'.$class.' btn-block']) ?>
            <?php endforeach; ?>

        <?php AuthChoice::end(); ?>
        </div>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
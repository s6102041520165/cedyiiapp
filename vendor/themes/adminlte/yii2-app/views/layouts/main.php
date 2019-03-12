<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->registerCssFile("https://use.fontawesome.com/releases/v5.7.1/css/all.css"); ?>
        <?php $this->registerCss("
        .content-wrapper{
            background-color:white;
        }
        .main-sidebar { 
            background-color: #d5e1df !important; 
        }
        .sidebar-form form-control{
            background-color:white;
        }
        .main-sidebar .sidebar-menu *{
            color:black;
        }
        .skin-green .sidebar-menu>li.header {
            background: #00a65a;
            font-size:18px;
        }
        .skin-green .sidebar-form .btn{
            background-color:#00a65a;
            color:white;
        }
        .skin-green .sidebar-menu>li:hover>a:hover{
            background-color:lightgreen;
        }
        .skin-green .sidebar-menu>li.active>a, .skin-green .sidebar-menu>li.menu-open>a {
            color: #fff;
            background: #6cf46c;
        }
        "); ?>

        
        
        <?php $this->head() ?>

        
    </head>
    <body class="hold-transition skin-green sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    
    </body>
    </html>
    <?php $this->endPage() ?>
    <script>

        $(document).ready(function(){
            setInterval(function(){
                $.ajax({
                    'url':'orders/checkorder',
                    'success': function(response){
                        
                    }
                });
            }, 10000);
        });

        </script>
<?php } ?>

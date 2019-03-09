<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav ">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        
                        <?php if(!(isset(Yii::$app->user->identity->picture))){ ?>
                            <img src="<?= $directoryAsset ?>/img/user.png" class="user-image" alt="User Image" />
                        <?php  } else { Yii::$app->user->identity->picture = ''; ?>
                            <img src="<?= Yii::$app->user->identity->picture ?>" class="user-image" alt="User Image" />
                            
                        <?php } ?>

                        
                        <?php if(!isset(Yii::$app->user->identity->username)){ ?>
                            <span class="hidden-xs">ผู้ใช้ทั่วไป</span>
                        <?php } else { ?>
                            <span class="hidden-xs"><?=Yii::$app->user->identity->username;?></span>
                        <?php } ?>
                        
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php if(!isset(Yii::$app->user->identity->picture)){ ?>
                                <img src="<?= $directoryAsset ?>/img/user.png" class="img-circle" alt="User Image" />
                            <?php  } else { ?>
                                <img src="<?= Yii::$app->user->identity->picture ?>" class="img-circle" alt="User Image" />
                            <?php } ?>

                            <p>
                                <?php if(isset(Yii::$app->user->identity->username)) {
                                    echo Yii::$app->user->identity->username;
                                } else { ?>
                                    ผู้ใช้ทั่วไป
                                <?php } ?>
                                
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li> -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                        <?php if(Yii::$app->user->isGuest) { ?>
                            <div class="pull-right">
                                <?= Html::a(
                                        'ลงชื่อเข้าใช้งาน',
                                        ['/site/logout'],
                                        ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <?php } ?>
                            <?php if(!(Yii::$app->user->isGuest)) { ?>
                                <div class="pull-right">
                                    <?= Html::a(
                                        'ออกจากระบบ',
                                        ['/site/logout'],
                                        ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                    ) ?>
                                </div>
                            <?php } ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
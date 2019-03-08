<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel" >
            <div class="pull-left image">
                <img src="<?php 
                if(Yii::$app->user->identity->picture!=NULL)
                    echo Yii::$app->user->identity->picture;
                else 
                   echo $directoryAsset."/img/user.png" ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
            <?php if(Yii::$app->user->identity->username!=NULL) { ?>
                <p class="text-info"><?= Yii::$app->user->identity->fname." ".Yii::$app->user->identity->lname; ?></p>

                <a href="#" class="text-black"><i class="fa fa-circle text-success"></i> ออนไลน์</a>
            <?php } else { ?>
                <p class="text-info">ผู้ใช้ทั่วไป</p>

                <a href="#" class="text-black"><i class="fa fa-circle text-danger"></i> ออฟไลน์</a>
            <?php } ?>
            </div>
        </div>

        <!-- search form -->
        <form action="/search/" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" style="background:white" class="form-control" placeholder="ค้นหา..." />
                <div class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn"><i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label'=>'เมนู','options'=>['class' => 'bg-primary header']],
                    ['label' => 'ลงชื่อเข้าใช้', 'icon' => 'lock' , 'url' => ['/site/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'จองโต๊ะ', 'icon' => 'circle' , 'url' => ['/booking'],'visible'=> Yii::$app->user->identity],
                    ['label' => 'แจ้งชำระเงิน', 'icon' => 'circle', 'url' => ['/booking/payment'],'visible'=> Yii::$app->user->identity->username],
                    ['label' => 'บัตรเข้างาน', 'icon' => 'circle', 'url' => ['/booking/about'],'visible'=> Yii::$app->user->identity->username],
                    /*['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],*/
                ],
            ]
        ) ?>

    </section>

</aside>
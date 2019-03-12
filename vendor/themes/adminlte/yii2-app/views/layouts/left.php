<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel" >
            <div class="pull-left image">
                <img src="<?=(isset(Yii::$app->user->identity->pictures))?Yii::$app->user->identity->pictures:$directoryAsset."/img/user.png";?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
            <?php if(isset(Yii::$app->user->identity->username)) { ?>
                <p class="text-info"><?= Yii::$app->user->identity->fname." ".Yii::$app->user->identity->lname; ?></p>

                <a href="#" class="text-black"><i class="fa fa-circle text-primary"></i> ออนไลน์</a>
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
                    ['label' => 'จองโต๊ะ', 'icon' => 'circle' , 'url' => ['/booking'],'visible'=> isset(Yii::$app->user->identity->username)],
                    ['label' => 'แจ้งชำระเงิน', 'icon' => 'bank', 'url' => ['/booking/payment'],'visible'=> isset(Yii::$app->user->identity->username)],
                    ['label' => 'บัตรเข้างาน', 'icon' => 'ticket', 'url' => ['/orders/'],'visible'=> isset(Yii::$app->user->identity->username)],
                    ['label' => 'โต๊ะและเก้าอี้', 'icon' => 'circle', 'url' => ['/diet/'],'visible'=> Yii::$app->user->identity->role==2],
                    ['label' => 'ผู้ใช้', 'icon' => 'user', 'url' => ['/user/'],'visible'=> Yii::$app->user->identity->role==2],
                    ['label' => 'ธนาคาร', 'icon' => 'user', 'url' => ['/bank/'],'visible'=> (Yii::$app->user->identity->role==2) || (Yii::$app->user->identity->role==3)],
                ],
            ]
        ) ?>

    </section>

</aside>
<?php
use Yii;
/**
 * @author  Agiel K. Saputra <13nightevil@gmail.com>
 */
class CedYii extends Yii
{
   public static function powered()
   {
   	echo "Copyright &copy; 2019 ComEdu Homecoming 2562.ติดต่อ 095-7051575 หรือ 095-9645173";
   }
}
?>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b><?= CedYii::powered() ?></b>
    </div>
    <strong>dCopyright &copy; <?= date('Y') . ' ' .CedYii::powered() ?>.</strong> All rights reserved.
</footer>

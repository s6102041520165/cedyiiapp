<?php
namespace app\assets;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{
  public $basePath = '@webroot';
  public $baseUrl = '@web';
  public $css = [
    'vendor/bootstrap/css/bootstrap.min.css'
  ];
  public $js = [
    'vendor/bootstrap/js/bootstrap.min.js',
    'vendor/popper.js/umd/popper.min.js'
  ];
}
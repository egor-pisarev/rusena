<?php
namespace app\themes\rusena\assets;

class Asset extends \yii\web\AssetBundle
{
    public $sourcePath = '@app/themes/rusena/web';
    public $css = [
        'css/style.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
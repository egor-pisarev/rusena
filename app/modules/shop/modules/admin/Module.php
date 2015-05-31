<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 29.05.15
 * Time: 19:20
 * To change this template use File | Settings | File Templates.
 */

namespace app\modules\shop\modules\admin;

class Module extends \yii\base\Module {

    public $settings = [
    ];

    public static $installConfig = [
        'title' => [
            'en' => 'Shop',
            'ru' => 'Магазин',
        ],
        'icon' => 'user',
        'order_num' => 65,
    ];

    public function init()
    {
        $this->layout = '@easyii/views/layouts/main';
        parent::init();
    }

}
<?php
namespace app\modules\user;

use Yii;

class UserModule extends \dektrium\user\Module
{
    public $settings = [
        'shortMaxLength' => 255,
    ];

    public static $installConfig = [
        'title' => [
            'en' => 'User',
            'ru' => 'Пользователи',
        ],
        'icon' => 'user',
        'order_num' => 65,
    ];

    public function init()
    {
        $this->setViewPath('@vendor/dektrium/yii2-user/views');
        parent::init();
    }
}
<?php
namespace app\modules\news;

class NewsModule extends \yii\easyii\components\Module
{
    public $settings = [
        'enableThumb' => true,
        'thumbWidth' => 100,
        'thumbHeight' => '',
        'thumbCrop' => false,

        'enableShort' => true,
        'shortMaxLength' => 256,
    ];

    public static $installConfig = [
        'title' => [
            'en' => 'News',
            'ru' => 'Новости',
        ],
        'icon' => 'bullhorn',
        'order_num' => 70,
    ];
}
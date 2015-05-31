<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 29.05.15
 * Time: 19:20
 * To change this template use File | Settings | File Templates.
 */

namespace app\modules\shop;

use Yii;

class Module extends \yii\base\Module {

    public function init()
    {
        parent::init();

        $this->modules = [
            'admin' => [
                'class' => 'app\modules\shop\modules\admin\Module',
            ],
        ];
        Yii::setAlias('@shop',__DIR__);
    }

}
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 29.05.15
 * Time: 22:17
 * To change this template use File | Settings | File Templates.
 */

namespace app\modules\shop\widgets;

use yii\bootstrap\Widget;

use Yii;

class Cart extends Widget{

    public function run()
    {
        $count = Yii::$app->cart->getCount();
        $cost = Yii::$app->cart->getCost();
        return $this->render('cart',['count'=>$count,'cost'=>$cost]);
    }

}
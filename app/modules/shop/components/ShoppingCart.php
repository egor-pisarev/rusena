<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 02.06.15
 * Time: 11:36
 * To change this template use File | Settings | File Templates.
 */

namespace app\modules\shop\components;

class ShoppingCart extends \yz\shoppingcart\ShoppingCart {


    public function removeById($id)
    {
        if(!isset($this->_positions[$id])){
            return;
        }
        parent::removeById($id);
    }
}
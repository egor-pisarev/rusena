<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 29.05.15
 * Time: 22:21
 * To change this template use File | Settings | File Templates.
 */
use yii\bootstrap\Html;
?>
<div id="cart-block" class="form-block">
    <a href="/" class="title">Козина</a>
    <span class="label">ТОВАРОВ В КОРЗИНЕ:</span><span class="value"><?=$count?></span>
    <span class="label">НА СУММУ:</span><span class="value"><?=$cost?> Р</span>
    <div class="actions">
        <?=Html::a('В корзну',['/shop/cart/list'],['class'=>'btn'])?>
        <?=Html::a('Оформить',['/shop/cart/order'],['class'=>'btn'])?>
    </div>
</div>
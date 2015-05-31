<?php
use \yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $products common\models\Product[] */
?>
<?php \yii\widgets\Pjax::begin(); ?>
<section>
    <h1>Корзина</h1>
    <div class="cart-list">
        <?php foreach ($products as $product):?>
            <div class="item">
                <table>
                    <tr>
                        <td class="image">
                            <?php
                            $images = $product->images;
                            if (isset($images[0])) {
                                echo  Html::a(Html::img($images[0]->getUrl(),['width'=>'100px']),['/shop/catalog/view','id'=>$product->id]);
                            }
                            ?>
                        </td>
                        <td class="content">
                            <?= Html::a($product->title,['shop/product/view','id'=>$product->id],['class'=>'title']) ?>
                            <p>
                                <?=$product->description?>
                            </p>
                            <div class="actions">
                                <?php $quantity = $product->getQuantity()?>
                                <?= Html::a('-', ['cart/update', 'id' => $product->getId(), 'quantity' => $quantity - 1], ['class' => 'subtract', 'disabled' => ($quantity - 1) < 1])?>
                                <input class="value" name="value" value="<?=$quantity?>">
                                <?= Html::a('+', ['cart/update', 'id' => $product->getId(), 'quantity' => $quantity + 1], ['class' => 'add'])?>
                                <?=Html::a('',['/shop/cart/list'],['class'=>'add-cart'])?>
                                <?= Html::a('Удалить', ['cart/remove', 'id' => $product->getId()], ['class' => 'remove-cart'])?>
                            </div>
                        </td>
                        <td class="price">
                            <span><?= $product->getCost() ?> Р</span>
                        </td>
                    </tr>
                </table>
            </div>

        <?php endforeach ?>


        <div class="item">
            <div class="summ">ИТОГО:<span><?= $total ?> P</span></div>
        </div>
        <div class="item last">
            <?=Html::a('Оформить заказ',['/shop/cart/order'],['class'=>'content-btn'])?>
        </div>
    </div>
</section>
<?php \yii\widgets\Pjax::end(); ?>

<?php
/* @var $this yii\web\View */
use yii\bootstrap\Html;
use yii\helpers\Markdown;

?>
<section>
    <h1><a href="#">Каталог</a>><a class="sub" href="#">Платья</a></h1>
    <div id="product-page">
        <div class="image">
            <?php
            $quantity=0;
            $position = Yii::$app->cart->getPositionById($model->id);
            if($position){
                $quantity = $position->quantity;
            }
            $images = $model->images;
            if (isset($images[0])) {
                echo Html::img($images[0]->getUrl(), ['width' => '100%']);
            }
            ?>
        </div>
        <div class="content">
            <h2 class="title"><?= $model->title?></h2>
            <div class="description">
                <?= Markdown::process($model->description) ?>
            </div>
            <div class="cart-form">
                <div class="actions">
                    <?= Html::a('-', ['/shop/cart/update', 'id' => $model->getId(), 'quantity' => $quantity - 1], ['class' => 'subtract', 'disabled' => ($quantity - 1) < 1])?>
                    <input class="value" name="value" value="<?=$quantity?>">
                    <?= Html::a('+', ['/shop/cart/update', 'id' => $model->getId(), 'quantity' => $quantity + 1], ['class' => 'add'])?>
                </div>
                <div class="price">
                    <?= $model->price ?> Р
                </div>
                <a class="add-cart"><span>В корзину</span></a>
            </div>
        </div>
    </div>
</section>

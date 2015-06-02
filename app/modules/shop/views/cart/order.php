<?php
use \yii\helpers\Html;
use \yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $products common\models\Product[] */
?>
<h1>Оформление заказа</h1>
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
</div>

<div class="row">
        <div class="col-xs-12">
            <?php
            /* @var $form ActiveForm */
            $form = ActiveForm::begin([
                'id' => 'order-form',
            ]) ?>

            <?= $form->field($order, 'phone') ?>
            <?= $form->field($order, 'email') ?>
            <?= $form->field($order, 'address')->textarea() ?>
            <?= $form->field($order, 'notes')->textarea() ?>

            <div class="form-group row">
                <div class="col-xs-12">
                    <?= Html::submitButton('Отправить заказ', ['class' => 'content-btn']) ?>
                </div>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    </div>

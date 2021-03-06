<?php
use yii\helpers\Html;
use yii\helpers\Markdown;
?>

<?php
$images = $model->images;
if (isset($images[0])) {
    echo '<div class="image">';
    echo  Html::a(Html::img($images[0]->getUrl(),['width'=>'199px']),['/shop/catalog/view','slug'=>$model->slug,'category'=>$model->getCategorySlug()]);
    echo '</div>';
}
$quantity=0;
$position = Yii::$app->cart->getPositionById($model->id);
if($position){
    $quantity = $position->quantity;
}

?>
<?= Html::a($model->title,['/shop/catalog/view','slug'=>$model->slug,'category'=>$model->getCategorySlug()],['class'=>'title']) ?>
<div class="price">
    <?= Yii::$app->formatter->asDecimal($model->price,2) ?> Р
</div>
<div class="actions">
    <?= Html::a('-', ['/shop/cart/update', 'id' => $model->getId(), 'quantity' => $quantity - 1], ['class' => 'subtract', 'disabled' => ($quantity - 1) < 1])?>
    <input class="value" name="value" value="<?=$quantity?>">
    <?= Html::a('+', ['/shop/cart/update', 'id' => $model->getId(), 'quantity' => $quantity + 1], ['class' => 'add'])?>
    <?=Html::a('',['/shop/cart/list'],['class'=>'add-cart'])?>
</div>


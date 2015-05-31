<?php
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
$title = $category === null ? 'Welcome!' : $category->title;
$this->title = Html::encode($title);
?>
<section>
    <h1>Каталог</h1>
    <div class="catalog-list items">
        <div class="row">
            <?= ListView::widget([
                'dataProvider' => $productsDataProvider,
                'itemView' => '_product',
                'itemOptions'=>[
                    'class'=>'item',
                ],
                'summary'=>'',
            ]) ?>
        </div>
    </div>
</section>


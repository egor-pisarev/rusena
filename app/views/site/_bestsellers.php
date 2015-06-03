<?php
use yii\widgets\ListView;
?>
<section>
    <h1>Хиты продаж</h1>
    <div class="catalog-list items">
        <div class="row">
            <?= ListView::widget([
                'dataProvider' => $productsDataProvider,
                'itemView' => '@app/modules/shop/views/catalog/_product',
                'itemOptions'=>[
                    'class'=>'item',
                ],
                'summary'=>'',
            ]) ?>
        </div>
    </div>
</section>
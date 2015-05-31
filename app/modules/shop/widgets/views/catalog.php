<?php
use yii\widgets\Menu;
?>
<div class="catalog-menu">
    <?= Menu::widget([
        'items' => $items,
    ]) ?>
</div>
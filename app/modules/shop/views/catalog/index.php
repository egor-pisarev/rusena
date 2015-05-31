<?php
use yii\bootstrap\Html;
?>
<section>
    <h1>Каталог</h1>
    <div class="catalog-list categories">
        <div class="row">
            <?php foreach($categories as $category):?>
            <div class="item">
                <?php
                if ($category->getBehavior('coverBehavior')->hasImage()) {
                    $image = Html::img($category->getBehavior('coverBehavior')->getUrl('medium'));
                    echo Html::a($image,['/shop/catalog/list/','slug'=>$category->slug],['class'=>'image']);
                }
                ?>
                <?=Html::a($category->title,['/shop/catalog/list','slug'=>$category->slug],['class'=>'title'])?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
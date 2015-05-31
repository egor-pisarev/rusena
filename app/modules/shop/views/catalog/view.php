<?php
/* @var $this yii\web\View */
use yii\bootstrap\Html;
use yii\helpers\Markdown;

?>
    <div class="col-xs-12 well">
        <div class="col-xs-2">
            <?php
            $images = $model->images;
            if (isset($images[0])) {
                echo Html::img($images[0]->getUrl(), ['width' => '100%']);
            }
            ?>
        </div>
        <div class="col-xs-6">
            <h3><?= $model->title?></h3>
            <?= Markdown::process($model->description) ?>
        </div>

        <div class="col-xs-4 price">
            <div class="row">
                <div class="col-xs-12">$<?= $model->price ?></div>
                <div class="col-xs-12"><?= Html::a('Add to cart', ['cart/add', 'id' => $model->id], ['class' => 'btn btn-success'])?></div>
            </div>
        </div>
    </div>

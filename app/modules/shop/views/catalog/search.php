<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>

<section>
    <h1><?=Html::a('Каталог',['/shop/catalog/index'])?>>Поиск</h1>
    <div class="catalog-list items">
        <div class="row">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_product',
                'itemOptions'=>[
                    'class'=>'item',
                ],
                'summary'=>'',
            ]) ?>
        </div>
    </div>
</section>

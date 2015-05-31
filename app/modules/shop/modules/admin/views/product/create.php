<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = 'Создание Товара';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?=$this->render('../blocks/shop-menu')?>

<div class="product-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>

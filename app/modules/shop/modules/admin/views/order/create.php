<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = 'Добавить Заказ';
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?=$this->render('../blocks/shop-menu')?>

<div class="order-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

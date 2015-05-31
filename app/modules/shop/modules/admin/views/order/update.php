<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = 'Обновить Заказ: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<?=$this->render('../blocks/shop-menu')?>

<div class="order-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = 'Заказ №'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?=$this->render('../blocks/shop-menu')?>

<div class="order-view">

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <h3>Информация о заказе</h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at:datetime',
            'updated_at:datetime',
            'user.username',
            'address',
            'phone',
            'email',
            'notes:ntext',
            'status',

        ],
    ]) ?>
<h3>Товары в заказе</h3>
    <?= GridView::widget([
        'dataProvider' => $itemsDataProvider,
        'columns' => [
            'title',
            [
                'attribute' => 'product.category_id',
                'value' => function ($model) {
                    return empty($model->product->category_id) ? '-' : $model->product->category->title;
                },
            ],
            'price',
            'quantity',
        ],
    ]); ?>

</div>

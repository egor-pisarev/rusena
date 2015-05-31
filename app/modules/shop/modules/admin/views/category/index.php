<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\shop\modules\admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>

<?=$this->render('../blocks/shop-menu')?>

<div class="category-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить Категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'title',
            [
                'attribute' => 'parent_id',
                'value' => function ($model) {
                    return empty($model->parent_id) ? '-' : $model->parent->title;
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{create} {view} {update} {delete}',
                'buttons' => [
                    'create' => function ($url, $model, $key) {
                         return Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>', $url);
                    }
                ],
            ],
        ],
    ]); ?>

</div>

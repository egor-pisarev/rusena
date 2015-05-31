<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\shop\modules\admin\models\Category */

$this->title = 'Редактирование Категории: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<?=$this->render('../blocks/shop-menu')?>

<div class="category-update">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>

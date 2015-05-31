<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\shop\modules\admin\models\Category */
/* @var $categories app\modules\shop\modules\admin\models\Category[] */

$this->title = 'Создание Категории';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?=$this->render('../blocks/shop-menu')?>

<div class="category-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>

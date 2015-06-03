<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zxbodya\yii2\imageAttachment\ImageAttachmentWidget;
use yii\easyii\widgets\SeoForm;

/* @var $this yii\web\View */
/* @var $model app\modules\shop\modules\admin\models\Category */
/* @var $categories app\modules\shop\modules\admin\models\Category[] */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map($categories, 'id', 'title'), ['prompt' => 'Root']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= ImageAttachmentWidget::widget(
        [
            'model' => $model,
            'behaviorName' => 'coverBehavior',
            'apiRoute' => 'imgAttachApi',
        ]
    )
    ?>

    <?= SeoForm::widget(['model' => $model]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

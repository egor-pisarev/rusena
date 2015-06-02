<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
?>
<?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'template' => "{input}\n{error}"
        ],
        'action' => '/shop/catalog/search',
        'options'=>[
            'role'=>'search',
            'class'=>'navbar-form navbar-left search-form',
        ],
        'method'=>'get',
    ]) ?>

    <div class="form-group">
        <?=Html::activeTextInput($model,'text',['class'=>'form-control','placeholder'=>'Поиск'])?>
    </div>
    <button type="submit" class="btn btn-default"></button>
<?php ActiveForm::end(); ?>

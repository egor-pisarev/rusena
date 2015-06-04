<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */
?>
<section>
    <h1><?=$page->title?></h1>
    <div class="page">

        <div id="contacts-block">
            <?=$page->text?>
        </div>

        <div id="map-block">
            <h2>СХЕМА ПРОЕЗДА</h2>
            <div id="map-container">
                <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=Btn03cuIyjpFHBIknATPteyiTaCAp9yO&width=870&height=450"></script>
            </div>
        </div>

<div id="callback-form">
    <h2>Обратная связь</h2>
    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
        <div class="alert alert-success">
            Ваше сообщение успешно отправлено. Спасибо, что связались с нами
        </div>
    <?php else: ?>
        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

        <div class="form-element">
            <?= $form->field($model, 'name')->textInput(['placeholder'=>'Ваше имя*']) ?>
        </div>
        <div class="form-element">
            <?= $form->field($model, 'email')->textInput(['placeholder'=>'E-mail*']) ?>
        </div>
        <div class="form-element">
            <?= $form->field($model, 'phone')->textInput(['placeholder'=>'Телефон']) ?>
        </div>
        <div class="form-element">
            <?= $form->field($model, 'body')->textarea(['placeholder'=>'Текст сообщения']) ?>
        </div>
        <div class="form-element" style="height: 100px">
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-6">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>
        </div>
        <div class="form-element submit">
            <input type="submit" value="Отправить" name="">
        </div>
        <?php ActiveForm::end(); ?>
    <?php endif; ?>

</div>


</div>
</section>
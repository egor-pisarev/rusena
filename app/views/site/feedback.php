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
    <?=yii\easyii\modules\feedback\api\Feedback::form()?>
</div>


</div>
</section>
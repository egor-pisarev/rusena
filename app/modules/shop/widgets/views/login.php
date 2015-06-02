<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\LoginForm $model
 * @var string $action
 */
?>

<?php if (Yii::$app->user->isGuest): ?>
    <div id="aut-form">
        <div class="title">Вход в кабинет</div>
        <?php $form = ActiveForm::begin([
            'fieldConfig' => [
                'template' => "{input}\n{error}"
            ],
            'action' => $action
        ]) ?>
        <div class="form-element">
            <?= Html::activeTextInput($model,'login',['placeholder' => 'Логин'])?>
        </div>
        <div class="form-element">
            <?= Html::activePasswordInput($model,'password',['placeholder' => 'Пароль'])?>
        </div>
        <div class="links">
            <?=Html::a('Регистрация',['user/register'])?>
            <?=Html::a('Забыли пароль?',['user/forgot'])?>
        </div>

        <div class="form-element submit">
            <input type="submit" value="Войти" name="submit">
        </div>

        <?php ActiveForm::end(); ?>

    </div>


<?php else: ?>
<div id="aut-form">
    <div class="title">Вы вошли как: <?=Yii::$app->user->identity->username?></div>
        <?= Html::a(Yii::t('user', 'Logout'), ['/user/security/logout'], ['class' => 'btn btn-block btn-notice', 'data-method' => 'post']) ?>
</div>

<?php endif ?>



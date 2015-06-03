<?php
$this->title = Yii::t('news', 'Edit news');
?>
<?= $this->render('_menu') ?>
<?= $this->render('_form', ['model' => $model]) ?>
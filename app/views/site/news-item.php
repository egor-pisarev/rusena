<?php use yii\bootstrap\Html; ?>
<h2><?= $news->title ?> <small><?= $news->date ?></small></h2>
<?=Html::img($news->thumb)?>
<?= $news->text ?>

<?php
use yii\easyii\modules\news\models\News;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('easyii', 'News');
?>

<?= $this->render('_menu') ?>
<form>
    <?=Html::textInput('title',$title,['placeholder'=>'Поиск по заголовку'])?>
</form>

<?php if($data->count > 0) : ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <?php if(IS_ROOT) : ?>
                    <th width="30">#</th>
                <?php endif; ?>
                <th><?= Yii::t('easyii', 'Title') ?></th>
                <th width="120"><?= Yii::t('easyii', 'Views') ?></th>
                <th width="100"><?= Yii::t('easyii', 'Status') ?></th>
                <th width="30"></th>
            </tr>
        </thead>
        <tbody>
    <?php foreach($data->models as $item) : ?>
            <tr>
                <?php if(IS_ROOT) : ?>
                    <td><?= $item->primaryKey ?></td>
                <?php endif; ?>
                <td><a href="<?= Url::to(['/admin/protectednews/a/edit/', 'id' => $item->primaryKey]) ?>"><?= $item->title ?></a></td>
                <td><?= $item->views ?></td>
                <td class="status">
                    <?= Html::checkbox('', $item->status == News::STATUS_ON, [
                        'class' => 'switch',
                        'data-id' => $item->primaryKey,
                        'data-link' => Url::to(['/admin/protectednews/a/']),
                    ]) ?>
                </td>
                <td class="control">
                    <a href="<?= Url::to(['/admin/protectednews/a/delete', 'id' => $item->primaryKey]) ?>" class="glyphicon glyphicon-remove confirm-delete" title="<?= Yii::t('easyii', 'Delete item') ?>"></a>
                    <a href="<?= Url::to(['/admin/protectednews/a/send-mails', 'id' => $item->primaryKey]) ?>" class="glyphicon glyphicon-envelope" title="Отправить сообщения"></a>
                </td>
            </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
    <?= yii\widgets\LinkPager::widget([
        'pagination' => $data->pagination
    ]) ?>
<?php else : ?>
    <p><?= Yii::t('easyii', 'No records found') ?></p>
<?php endif; ?>
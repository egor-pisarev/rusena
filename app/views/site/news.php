<?php
use yii\easyii\modules\news\api\News;
use yii\bootstrap\Html;
?>
    <section>
        <h1>Новости</h1>
        <div class="news-list">
            <?php foreach(News::all(["pageSize" => 2]) as $news) : ?>

                <div class="news">
                    <div class="date">
                        <span class="day"><?= date('d',$news->time) ?></span>
                        <span class="month"><?= date('m',$news->time) ?></span>
                        <span class="year"><?= date('Y',$news->time) ?></span>
                    </div>
                    <div class="content">
                        <?=Html::a($news->title,['/site/news','id'=>$news->id],['class'=>'title'])?>
                        <p>
                            <?= $news->short ?>
                        </p>
                        <?=Html::a('подробнее',['/site/news','id'=>$news->id],['class'=>'more'])?>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?= News::pages() ?>
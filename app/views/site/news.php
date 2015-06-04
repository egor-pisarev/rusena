<?php
use app\modules\news\api\News;
use yii\bootstrap\Html;
$asset = \app\themes\rusena\assets\Asset::register($this);

?>
    <section>
        <h1>Новости <?=Html::a(Html::img($asset->baseUrl.'/images/rss.png',['width'=>'24px']),['/site/rss'])?></h1>
        <div class="news-list">
            <?php foreach(News::all(["pageSize" => 2,'where'=>['type'=>$types]]) as $news) : ?>

                <div class="news">
                    <div class="date">
                        <span class="day"><?= date('d',$news->time) ?></span>
                        <span class="month"><?= date('m',$news->time) ?></span>
                        <span class="year"><?= date('Y',$news->time) ?></span>
                    </div>
                    <div class="content">
                        <?=Html::a($news->title,['/site/news','slug'=>$news->slug],['class'=>'title'])?>
                        <p>
                            <?= $news->short ?>
                        </p>
                        <?=Html::a('подробнее',['/site/news','slug'=>$news->slug],['class'=>'more'])?>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?= News::pages() ?>
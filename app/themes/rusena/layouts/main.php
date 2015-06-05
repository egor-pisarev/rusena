<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\modules\shop\widgets\Cart;
use app\modules\shop\widgets\Login;
use app\modules\shop\widgets\Catalog;
use app\modules\shop\widgets\Search;

use app\modules\news\api\News;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
$asset = \app\themes\rusena\assets\Asset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo Html::encode($this->title); ?></title>
        <?php $this->head(); ?>

		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
    <?php $this->beginBody() ?>

    <header>
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="logo-box">
							<a id="logo" href="/">
								Русена
							</a>
							<span id="site-slogan">
								ЖЕНСКАЯ ОДЕЖДА<br/>ИЗ ПОЛЬСКИХ И ТУРЕЦКИХ ТКАНЕЙ
							</span>
						</div>
					</div>
					<div class="col-md-6">
						<?=Cart::widget()?>
					</div>
				</div>
			</div>
		</header>
		<div id="main-menu">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<nav class="navbar navbar-default" role="navigation">

							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                                <?php
                                echo Menu::widget([
                                    'options' => [ 'class' => 'nav navbar-nav'],
                                    'items' => [
                                        ['label' => 'Главная', 'url' => ['/site/index']],
                                        ['label' => 'О компании', 'url' => ['/page/about']],
                                        ['label' => 'Новости', 'url' => ['/news']],
                                        ['label' => 'Каталог', 'url' => ['/catalog']],
                                        ['label' => 'Доставка и оплата', 'url' => ['/page/information']],
                                        ['label' => 'Таблица размеров', 'url' => ['/page/size']],
                                        ['label' => 'Контакты', 'url' => ['/site/feedback']],
                                    ],
                                ]);
                                ?>
                                <?=Search::widget()?>

							</div>

						</nav>
					</div>
				</div>
			</div>
		</div>
	<main>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
                <?php if(Yii::$app->controller->action->id != 'login'):?>
					<div class="aside-block">
                        <?=Login::widget()?>
					</div>
                <?php endif; ?>

                    <div class="aside-block">
						<a class="title catalog-title" href="#">Каталог</a>
                        <?=Catalog::widget()?>
					</div>
					<div class="aside-block">
                        <?php if(Yii::$app->controller->action->id != 'news'):?>
                            <?php  $types = [1];
                            if(!Yii::$app->user->isGuest){
                                $types[] = 2;
                            }
                            ?>
                            <?=Html::a('Новости',['/site/news'],['class'=>'title news-title'])?>
                            <div class="news-block">
                                <?php foreach(News::all(["pageSize" => 2,'where'=>['type'=>$types]]) as $news) : ?>
                                    <div class="news">
                                        <div class="date"><?= $news->time ?></div>
                                        <?=Html::a($news->title,['/site/news','slug'=>$news->slug])?>
                                        <div class="text">
                                            <p><?= $news->short ?></p>
                                        </div>
                                        <?=Html::a('Подробнее',['/site/news','slug'=>$news->slug],['class'=>'more'])?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
					</div>
				</div>
				<div class="col-md-9">
                    <?=$content?>
				</div>
			</div>
		</div>
	</main>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<a id="footer-logo" href="/">Русена</a>
                    <!-- Yandex.Metrika informer -->
                    <a href="https://metrika.yandex.ru/stat/?id=30752153&amp;from=informer"
                       target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/30752153/3_1_FF31A8FF_E61188FF_0_pageviews"
                                                           style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:30752153,lang:'ru'});return false}catch(e){}"/></a>
                    <!-- /Yandex.Metrika informer -->

                    <!-- Yandex.Metrika counter -->
                    <script type="text/javascript">
                        (function (d, w, c) {
                            (w[c] = w[c] || []).push(function() {
                                try {
                                    w.yaCounter30752153 = new Ya.Metrika({id:30752153,
                                        clickmap:true,
                                        trackLinks:true,
                                        accurateTrackBounce:true});
                                } catch(e) { }
                            });

                            var n = d.getElementsByTagName("script")[0],
                                s = d.createElement("script"),
                                f = function () { n.parentNode.insertBefore(s, n); };
                            s.type = "text/javascript";
                            s.async = true;
                            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                            if (w.opera == "[object Opera]") {
                                d.addEventListener("DOMContentLoaded", f, false);
                            } else { f(); }
                        })(document, window, "yandex_metrika_callbacks");
                    </script>
                    <noscript><div><img src="//mc.yandex.ru/watch/30752153" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                    <!-- /Yandex.Metrika counter -->
				</div>
				<div class="col-md-4">
					<div id="nav-footer" class="footer-menu">
                        <?php
                        echo Menu::widget([
                            'items' => [
                                ['label' => 'Главная', 'url' => ['/site/index']],
                                ['label' => 'О компании', 'url' => ['/page/about']],
                                ['label' => 'Новости', 'url' => ['/news']],
                                ['label' => 'Каталог', 'url' => ['/catalog']],
                                ['label' => 'Доставка и оплата', 'url' => ['/page/information']],
                                ['label' => 'Таблица размеров', 'url' => ['/page/size']],
                                ['label' => 'Контакты', 'url' => ['/site/feedback']],
                            ],
                        ]);
                        ?>
					</div>
					<div id="catalog-footer"  class="footer-menu">
                        <?=Catalog::widget()?>
                    </div>
				</div>
				<div class="col-md-4">
					<div class="footer-links">
						<a href="#" class="item">
							<div class="image">
							</div>
							<span>Разработка сайта</span>
						</a>
						<a href="#" class="item">
							<div class="image">
							</div>
							<span>Дизайн сайта</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage(); ?>
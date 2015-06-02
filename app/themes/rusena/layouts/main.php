<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\modules\shop\widgets\Cart;
use app\modules\shop\widgets\Login;
use app\modules\shop\widgets\Catalog;
use yii\easyii\modules\news\api\News;

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
                                <form class="navbar-form navbar-left search-form" role="search">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Поиск">
                                    </div>
                                    <button type="submit" class="btn btn-default"></button>
                                </form>
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
                            <?=Html::a('Новости',['/site/news'],['class'=>'title news-title'])?>
                            <div class="news-block">
                                <?php foreach(News::all(["pageSize" => 2]) as $news) : ?>
                                    <div class="news">
                                        <div class="date"><?= $news->time ?></div>
                                        <a href="/news/view/<?= $news->id ?>"><?= $news->title ?></a>
                                        <div class="text">
                                            <p><?= $news->short ?></p>
                                        </div>
                                        <a href="/news/view/<?= $news->id ?>" class="more">Подробнее</a>
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
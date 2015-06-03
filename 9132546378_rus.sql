-- phpMyAdmin SQL Dump
-- version 4.0.10.9
-- http://www.phpmyadmin.net
--
-- Хост: 10.0.0.161:3307
-- Время создания: Июн 03 2015 г., 09:30
-- Версия сервера: 5.5.41-37.0-log
-- Версия PHP: 5.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `9132546378_rus`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-category-parent_id-category-id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `parent_id`, `title`, `slug`) VALUES
(1, NULL, 'Блузки', 'bluzki'),
(3, NULL, 'Платья', 'plata'),
(4, NULL, 'Жакеты', 'zakety'),
(5, NULL, 'Водолазки', 'vodolazki');

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_admins`
--

CREATE TABLE IF NOT EXISTS `easyii_admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `auth_key` varchar(128) NOT NULL,
  `access_token` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `access_token` (`access_token`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_article_categories`
--

CREATE TABLE IF NOT EXISTS `easyii_article_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `thumb` varchar(128) DEFAULT NULL,
  `order_num` int(11) NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `easyii_article_categories`
--

INSERT INTO `easyii_article_categories` (`category_id`, `title`, `thumb`, `order_num`, `slug`, `status`) VALUES
(1, 'Категория', '/uploads/article/friend-82dfc38a8a.jpg', 1, 'kategoria', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_article_items`
--

CREATE TABLE IF NOT EXISTS `easyii_article_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `thumb` varchar(128) DEFAULT NULL,
  `short` varchar(1024) DEFAULT NULL,
  `text` text NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `views` int(11) DEFAULT '0',
  `order_num` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_carousel`
--

CREATE TABLE IF NOT EXISTS `easyii_carousel` (
  `carousel_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(128) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `text` text,
  `order_num` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`carousel_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_catalog_categories`
--

CREATE TABLE IF NOT EXISTS `easyii_catalog_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `fields` text NOT NULL,
  `thumb` varchar(128) DEFAULT NULL,
  `order_num` int(11) NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `easyii_catalog_categories`
--

INSERT INTO `easyii_catalog_categories` (`category_id`, `title`, `fields`, `thumb`, `order_num`, `slug`, `status`) VALUES
(1, 'Футболки', '[{"name":"price","title":"\\u0426\\u0435\\u043d\\u0430","type":"string","options":""},{"name":"article","title":"\\u0410\\u0440\\u0442\\u0438\\u043a\\u0443\\u043b","type":"string","options":""}]', '/uploads/catalog/man-c9ba6fed42.jpg', 1, 'futbolki', 1),
(2, 'Женские футболки', '[{"name":"price","title":"\\u0426\\u0435\\u043d\\u0430","type":"string","options":""}]', '/uploads/catalog/map-9c25ec8318.jpg', 2, 'zenskie-futbolki', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_catalog_items`
--

CREATE TABLE IF NOT EXISTS `easyii_catalog_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `description` text,
  `data` text NOT NULL,
  `thumb` varchar(128) DEFAULT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `order_num` int(11) NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `easyii_catalog_items`
--

INSERT INTO `easyii_catalog_items` (`item_id`, `category_id`, `title`, `description`, `data`, `thumb`, `slug`, `order_num`) VALUES
(1, 1, 'Футболка красная', '<p>Футболка красная</p>', '{"price":"120","article":"123423451"}', '/uploads/catalog/map-c6ccd227e5.jpg', 'futbolka-krasnaa', 1),
(2, 2, '111', '<p>ddd</p>', '{"price":"ddd"}', '', '111', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_faq`
--

CREATE TABLE IF NOT EXISTS `easyii_faq` (
  `faq_id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `order_num` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`faq_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_feedback`
--

CREATE TABLE IF NOT EXISTS `easyii_feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `text` text NOT NULL,
  `answer` text,
  `time` int(11) DEFAULT '0',
  `ip` varchar(16) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`feedback_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `easyii_feedback`
--

INSERT INTO `easyii_feedback` (`feedback_id`, `name`, `email`, `phone`, `title`, `text`, `answer`, `time`, `ip`, `status`) VALUES
(1, 'Егор', 'egor.pisarev@gmail.com', '89132546378', 'Заголовок', 'Текст', NULL, 1432800593, '127.0.0.1', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_files`
--

CREATE TABLE IF NOT EXISTS `easyii_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `file` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `downloads` int(11) DEFAULT '0',
  `time` int(11) DEFAULT '0',
  `order_num` int(11) NOT NULL,
  PRIMARY KEY (`file_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_gallery_albums`
--

CREATE TABLE IF NOT EXISTS `easyii_gallery_albums` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `thumb` varchar(128) DEFAULT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `order_num` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`album_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_guestbook`
--

CREATE TABLE IF NOT EXISTS `easyii_guestbook` (
  `guestbook_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `title` varchar(128) DEFAULT NULL,
  `text` text NOT NULL,
  `answer` text,
  `time` int(11) DEFAULT '0',
  `ip` varchar(16) NOT NULL,
  `new` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`guestbook_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_loginform`
--

CREATE TABLE IF NOT EXISTS `easyii_loginform` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `user_agent` varchar(1024) NOT NULL,
  `time` int(11) DEFAULT '0',
  `success` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `easyii_loginform`
--

INSERT INTO `easyii_loginform` (`log_id`, `username`, `password`, `ip`, `user_agent`, `time`, `success`) VALUES
(1, 'root', '******', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.6.0', 1432749108, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_migration`
--

CREATE TABLE IF NOT EXISTS `easyii_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `easyii_migration`
--

INSERT INTO `easyii_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1432749107),
('m000000_000000_install', 1432749108);

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_modules`
--

CREATE TABLE IF NOT EXISTS `easyii_modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `class` varchar(128) NOT NULL,
  `title` varchar(128) NOT NULL,
  `icon` varchar(32) NOT NULL,
  `settings` text NOT NULL,
  `notice` int(11) DEFAULT '0',
  `order_num` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `easyii_modules`
--

INSERT INTO `easyii_modules` (`module_id`, `name`, `class`, `title`, `icon`, `settings`, `notice`, `order_num`, `status`) VALUES
(1, 'article', 'yii\\easyii\\modules\\article\\ArticleModule', 'Articles', 'pencil', '{"categoryThumb":true,"categoryThumbCrop":true,"categoryThumbWidth":100,"categoryThumbHeight":100,"articleThumb":true,"articleThumbCrop":true,"articleThumbWidth":100,"articleThumbHeight":100,"enableShort":true,"shortMaxLength":255}', 0, 65, 0),
(2, 'carousel', 'yii\\easyii\\modules\\carousel\\CarouselModule', 'Carousel', 'picture', '{"imageWidth":1000,"imageHeight":400,"imageCrop":true,"enableTitle":true,"enableText":true}', 0, 40, 0),
(3, 'catalog', 'yii\\easyii\\modules\\catalog\\CatalogModule', 'Catalog', 'list-alt', '{"itemDescription":true,"categoryThumb":true,"categoryThumbCrop":true,"categoryThumbWidth":100,"categoryThumbHeight":100,"itemThumb":true,"itemThumbCrop":true,"itemThumbWidth":100,"itemThumbHeight":100,"itemPhotos":true,"photoMaxWidth":1280,"photoThumbCrop":true,"photoThumbWidth":100,"photoThumbHeight":100}', 0, 100, 0),
(4, 'faq', 'yii\\easyii\\modules\\faq\\FaqModule', 'FAQ', 'question-sign', '[]', 0, 45, 0),
(5, 'feedback', 'yii\\easyii\\modules\\feedback\\FeedbackModule', 'Feedback', 'earphone', '{"enableTitle":true,"enablePhone":true,"answerHello":"Hello,","answerFooter":"Best regards.","enableCaptcha":false}', 0, 60, 1),
(6, 'file', 'yii\\easyii\\modules\\file\\FileModule', 'Files', 'floppy-disk', '[]', 0, 30, 0),
(7, 'gallery', 'yii\\easyii\\modules\\gallery\\GalleryModule', 'Photo Gallery', 'camera', '{"photoMaxWidth":1280,"photoThumbWidth":100,"photoThumbHeight":100,"photoThumbCrop":true,"albumThumb":true,"albumThumbWidth":100,"albumThumbHeight":100,"albumThumbCrop":true}', 0, 90, 0),
(8, 'guestbook', 'yii\\easyii\\modules\\guestbook\\GuestbookModule', 'Guestbook', 'book', '{"enableTitle":false,"preModerate":false,"enableCaptcha":true}', 0, 80, 0),
(9, 'news', 'yii\\easyii\\modules\\news\\NewsModule', 'News', 'bullhorn', '{"enableThumb":true,"thumbWidth":100,"thumbHeight":"","thumbCrop":false,"enableShort":true,"shortMaxLength":256}', 0, 70, 1),
(10, 'page', 'yii\\easyii\\modules\\page\\PageModule', 'Pages', 'file', '[]', 0, 50, 1),
(11, 'subscribe', 'yii\\easyii\\modules\\subscribe\\SubscribeModule', 'E-mail subscribe', 'envelope', '[]', 0, 10, 0),
(12, 'text', 'yii\\easyii\\modules\\text\\TextModule', 'Text blocks', 'font', '[]', 0, 20, 1),
(16, 'user', 'app\\modules\\user\\UserModule', 'User', 'user', '{"shortMaxLength":255}', 0, 101, 1),
(20, 'shop', 'app\\modules\\shop\\modules\\admin\\Module', 'Shop', 'shopping-cart', '[]', 0, 102, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_news`
--

CREATE TABLE IF NOT EXISTS `easyii_news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `thumb` varchar(128) DEFAULT NULL,
  `short` varchar(1024) DEFAULT NULL,
  `text` text NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `time` int(11) DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`news_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `easyii_news`
--

INSERT INTO `easyii_news` (`news_id`, `title`, `thumb`, `short`, `text`, `slug`, `time`, `views`, `status`) VALUES
(1, 'Новость', '/uploads/news/man-1efefa45a5.jpg', 'Если кратко, то', '<p><img style="width: 413px;" src="/uploads/news/xe4wrgjzivm-b2fdfcd3f6.jpg"></p><p>Если кратко, то</p>', 'novost', 1432802068, 3, 1),
(2, 'Новость', '/uploads/news/friend-1a0ceba281.jpg', 'Появилась карта друг', '<p>Появилась карта друг</p>', 'novost-2', 1432802134, 6, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_pages`
--

CREATE TABLE IF NOT EXISTS `easyii_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `text` text NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`page_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `easyii_pages`
--

INSERT INTO `easyii_pages` (`page_id`, `title`, `text`, `slug`) VALUES
(1, 'О компании', '<section style="">\r\n<p class="page"></p><h3 style=""> Производство и оптовая продажа стильной женской одежды из Польских и Турецких тканей.</h3><h3>Принимаем заказы от оптовых покупателей</h3><p style="">\r\n	<br>\r\n	 Поставки в торговую сеть регионов<br>\r\n	 <br>\r\n	 Наш адрес:<br>\r\n	 630124, Россия<br>\r\n	 г. Новосибирск<br>\r\n	 Есенина, 41</p><p style="">\r\n	<strong> 				Менеджер:<br>\r\n	 				тел.  +7 913 942-10-03 			Email: <a href="mailto:rusena33@mail.ru">rusena33@mail.ru</a><br>\r\n	 				  			Административный отдел:<br>\r\n	 			тел.  +7 913 987-98-57<br>\r\n	 			тел.  +7 913 901-54-15 		 		  			<a href="skype:rusena333?call"><img src="http://rusena.ru/images/skypes.jpg" alt="Задать вопрос через Skype" border="0"></a></strong></p><p>\r\n	<strong><a href="skype:rusena333?call">rusena333</a></strong></p></section>', 'about'),
(2, 'Таблица размеров', '<section>\r\n						<h1>Таблица размеров</h1>\r\n						<div class="page">\r\n							<div id="table-size">\r\n								<div class="image"></div>\r\n								<div class="table">\r\n								<table>\r\n									<tbody><tr>\r\n										<th>RUS</th>\r\n										<th>UNI</th>\r\n										<th>ОГ</th>\r\n										<th>ОТ</th>\r\n										<th>ОБ</th>\r\n										<th>ВГ</th>\r\n										<th>ОВЧР</th>\r\n									</tr>\r\n									<tr>\r\n										<td>40</td>\r\n										<td>XS</td>\r\n										<td>80</td>\r\n										<td>80</td>\r\n										<td>80</td>\r\n										<td>80</td>\r\n										<td>80</td>\r\n									</tr>\r\n									<tr>\r\n										<td>40</td>\r\n										<td>XS</td>\r\n										<td>80-84</td>\r\n										<td>80-84</td>\r\n										<td>80-84</td>\r\n										<td>80-84</td>\r\n										<td>80-84</td>\r\n									</tr>\r\n									<tr>\r\n										<td>42</td>\r\n										<td>S</td>\r\n										<td>84-88</td>\r\n										<td>84-88</td>\r\n										<td>84-88</td>\r\n										<td>84-88</td>\r\n										<td>84-88</td>\r\n									</tr>\r\n									<tr>\r\n										<td>42</td>\r\n										<td>S</td>\r\n										<td>88-92</td>\r\n										<td>88-92</td>\r\n										<td>88-92</td>\r\n										<td>88-92</td>\r\n										<td>88-92</td>\r\n									</tr>\r\n									<tr>\r\n										<td>44</td>\r\n										<td>M</td>\r\n										<td>96-100</td>\r\n										<td>96-100</td>\r\n										<td>96-100</td>\r\n										<td>96-100</td>\r\n										<td>96-100</td>\r\n									</tr>\r\n									<tr>\r\n										<td>44</td>\r\n										<td>M</td>\r\n										<td>100-104</td>\r\n										<td>100-104</td>\r\n										<td>100-104</td>\r\n										<td>100-104</td>\r\n										<td>100-104</td>\r\n									</tr>\r\n									<tr>\r\n										<td>46</td>\r\n										<td>L</td>\r\n										<td>104-108</td>\r\n										<td>104-108</td>\r\n										<td>104-108</td>\r\n										<td>104-108</td>\r\n										<td>104-108</td>\r\n									</tr>\r\n									<tr>\r\n										<td>48</td>\r\n										<td>L</td>\r\n										<td>108-112</td>\r\n										<td>108-112</td>\r\n										<td>108-112</td>\r\n										<td>108-112</td>\r\n										<td>108-112</td>\r\n									</tr>\r\n									<tr>\r\n										<td>50</td>\r\n										<td>XL</td>\r\n										<td>112-116</td>\r\n										<td>112-116</td>\r\n										<td>112-116</td>\r\n										<td>112-116</td>\r\n										<td>112-116</td>\r\n									</tr>\r\n									<tr>\r\n										<td>50</td>\r\n										<td>XL</td>\r\n										<td>116-120</td>\r\n										<td>116-120</td>\r\n										<td>116-120</td>\r\n										<td>116-120</td>\r\n										<td>116-120</td>\r\n									</tr>\r\n									<tr>\r\n										<td>52</td>\r\n										<td>XXL</td>\r\n										<td>120-124</td>\r\n										<td>120-124</td>\r\n										<td>120-124</td>\r\n										<td>120-124</td>\r\n										<td>120-124</td>\r\n									</tr>\r\n								</tbody></table>\r\n									</div>\r\n								<div class="description">\r\n									<h3>Обозначения:</h3>\r\n									<ul>\r\n										<li><span>ОГ</span> - Обхват груди</li>\r\n										<li><span>ОТ</span> - Обхват талии</li>\r\n										<li><span>ОБ</span> - Обхват бедер</li>\r\n										<li><span>ВГ</span> - Высота груди</li>\r\n										<li><span>ОВЧР</span> - Обхват верхней части рукава</li>\r\n									</ul>\r\n								</div>\r\n							</div>\r\n							\r\n						</div>\r\n					</section>', 'size'),
(3, 'Доставка', '<p>Доставка</p>', 'information');

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_photos`
--

CREATE TABLE IF NOT EXISTS `easyii_photos` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(128) NOT NULL,
  `item_id` int(11) NOT NULL,
  `thumb` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `order_num` int(11) NOT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `model_item` (`model`,`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `easyii_photos`
--

INSERT INTO `easyii_photos` (`photo_id`, `model`, `item_id`, `thumb`, `image`, `description`, `order_num`) VALUES
(1, 'yii\\easyii\\modules\\catalog\\models\\Item', 1, '/uploads/photos/100x100/friend-36a3c0071f.jpg', '/uploads/photos/friend-36a3c0071f.jpg', 'Вот она сбоку', 1),
(2, 'yii\\easyii\\modules\\catalog\\models\\Item', 1, '/uploads/photos/100x100/ig4b4hjs4e-44a4181d1f.jpg', '/uploads/photos/ig4b4hjs4e-44a4181d1f.jpg', 'Футболка красная', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_seotext`
--

CREATE TABLE IF NOT EXISTS `easyii_seotext` (
  `seotext_id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(128) NOT NULL,
  `item_id` int(11) NOT NULL,
  `h1` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `keywords` varchar(128) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`seotext_id`),
  UNIQUE KEY `model_item` (`model`,`item_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `easyii_seotext`
--

INSERT INTO `easyii_seotext` (`seotext_id`, `model`, `item_id`, `h1`, `title`, `keywords`, `description`) VALUES
(1, 'yii\\easyii\\modules\\catalog\\models\\Category', 1, 'Футболки', 'Футболки', 'Футболки', 'Футболки'),
(2, 'yii\\easyii\\modules\\catalog\\models\\Item', 1, 'Футболка красная', 'Футболкакрасная', 'Футболка красная', 'Футболка красная'),
(3, 'yii\\easyii\\modules\\page\\models\\Page', 1, 'О компании h1', 'Производство и оптовая продажа стильной женской одежды из Польских и Турецких тканей.', 'Производство и оптовая продажа стильной женской одежды из Польских и Турецких тканей.', 'Производство и оптовая продажа стильной женской одежды из Польских и Турецких тканей.'),
(4, 'app\\modules\\shop\\models\\Product', 1, 'fbdf', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_settings`
--

CREATE TABLE IF NOT EXISTS `easyii_settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `title` varchar(128) NOT NULL,
  `value` varchar(1024) NOT NULL,
  `visibility` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`setting_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `easyii_settings`
--

INSERT INTO `easyii_settings` (`setting_id`, `name`, `title`, `value`, `visibility`) VALUES
(1, 'easyii_version', 'EasyiiCMS version', '1.1', 0),
(2, 'recaptcha_key', 'ReCaptcha key', '6Lc5fgcTAAAAAJH8oXn64ERStbG4aY4-qLn0gm3U', 1),
(3, 'password_salt', 'Password salt', '08hgQLGYqxCn1b9wnno_q25KyIcLJhhn', 0),
(4, 'root_auth_key', 'Root authorization key', 't4zmvb11d617wZaqji9--DZWg_Hu941V', 0),
(5, 'root_password', 'Root password', '0448775c86fbf0eee7d71dbc72c4bf4a88b76ab7', 1),
(6, 'auth_time', 'Auth time', '86400', 1),
(7, 'robot_email', 'Robot E-mail', 'noreply@easyiicms.local', 1),
(8, 'admin_email', 'Admin E-mail', 'egor.pisarev@gmail.com', 2),
(9, 'recaptcha_secret', 'ReCaptcha secret', '6Lc5fgcTAAAAAP_IMK1Ijms6uIQDhqZVE0Iz9cof', 1),
(10, 'toolbar_position', 'Frontend toolbar position ("top" or "bottom")', 'bottom', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_subscribe_history`
--

CREATE TABLE IF NOT EXISTS `easyii_subscribe_history` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(128) NOT NULL,
  `body` text NOT NULL,
  `sent` int(11) DEFAULT '0',
  `time` int(11) DEFAULT '0',
  PRIMARY KEY (`history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_subscribe_subscribers`
--

CREATE TABLE IF NOT EXISTS `easyii_subscribe_subscribers` (
  `subscriber_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `ip` varchar(16) NOT NULL,
  `time` int(11) DEFAULT '0',
  PRIMARY KEY (`subscriber_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `easyii_texts`
--

CREATE TABLE IF NOT EXISTS `easyii_texts` (
  `text_id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`text_id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-image-product_id-product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `image`
--

INSERT INTO `image` (`id`, `product_id`) VALUES
(15, 1),
(14, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1432792790),
('m140209_132017_init', 1432792793),
('m140403_174025_create_account_table', 1432792793),
('m140504_113157_update_tables', 1432792797),
('m140504_130429_create_token_table', 1432792797),
('m140830_171933_fix_ip_field', 1432792797),
('m140830_172703_change_account_table_name', 1432792797),
('m141123_221351_shop', 1432906750),
('m141222_110026_update_ip_field', 1432792798);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `created_at`, `updated_at`, `phone`, `address`, `email`, `notes`, `status`, `user_id`) VALUES
(1, 1433232690, 1433232690, '89123234', '', 'admin@admin.ru', '', 'Новый', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(19,4) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-order_item-order_id-order-id` (`order_id`),
  KEY `fk-order_item-product_id-product-id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `title`, `price`, `product_id`, `quantity`) VALUES
(1, 1, 'Женская блузка', '1200.0000', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `category_id` int(11) DEFAULT NULL,
  `price` decimal(19,4) DEFAULT NULL,
  `is_bestseller` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-product-category_id-category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `title`, `slug`, `description`, `category_id`, `price`, `is_bestseller`) VALUES
(1, 'Женская блузка', 'zenskaa-bluzka', 'Блуза ЛЕТО состав полиэстер, размер с 46 по 56. ', 1, '1200.0000', 1),
(2, 'Блуза Лето', 'bluza-leto', 'Блуза ЛЕТО состав полиэстер, размер с 46 по 56. ', 1, '1200.0000', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`) VALUES
(1, NULL, NULL, 'egor.pisarev@gmail.com', '483813bfb188e47c816e5914ab94d203', NULL, NULL, NULL),
(2, NULL, NULL, 'egor@egor.ru', '027a75b5f8692258a648987c9105e10a', NULL, NULL, NULL),
(3, NULL, NULL, 'admin@admin.ru', '2e64a65177d9b1008b2b7895e1090c8d', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `social_account`
--

CREATE TABLE IF NOT EXISTS `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  KEY `fk_user_account` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `token`
--

INSERT INTO `token` (`user_id`, `code`, `created_at`, `type`) VALUES
(1, 'L3BA2jrV0nBUgB7Nc7G7XbCb7vI5mFar', 1432792822, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`) VALUES
(1, 'egor', 'egor.pisarev@gmail.com', '$2y$10$PNoTc7WgabKEms6Wzxgan.iR.iy9ASfq024Eghw78s8DIbcj63z0y', 'nGNalfi_ayzJN7WMLk744o7D_THVHnLF', 1433268563, NULL, NULL, '127.0.0.1', 1432792822, 1432792822, 0),
(2, 'egor1', 'egor@egor.ru', '$2y$10$F/ofuGziwWS1wOCaL3cyv.Aot9/e.8C63X6UYaApqmDU8s9Qzi5Le', 'h6KIE2U7phXSwi_X9aKflYqSirIcgGwC', 1433218585, NULL, NULL, '178.186.38.237', 1433218585, 1433218585, 0),
(3, 'admin', 'admin@admin.ru', '$2y$10$lwIyQBehhSB.FsYS7S0rL.5k2itYm8QPREHHMsZnpjxOfWn7V1oVq', 'TrkY8Vpp-a4-AQMrqBR2eBkQK9m1wn1a', 1433221667, NULL, NULL, '178.186.38.237', 1433221667, 1433221667, 0);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `fk-category-parent_id-category-id` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk-image-product_id-product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `fk-order_item-order_id-order-id` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-order_item-product_id-product-id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk-product-category_id-category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Ограничения внешнего ключа таблицы `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

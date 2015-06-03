<?php
namespace app\modules\news\api;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\widgets\LinkPager;

use yii\easyii\modules\news\models\News as NewsModel;

/**
 * Class News
 * @package yii\easyii\modules\news\api
 *
 * @method static \stdClass get(mixed $id_slug) Get news object by id or slug
 * @method static array all(array $options = []) Get all news
 * @method static mixed last(int $limit = 1) Get last posts
 * @method static string pages() returns pagination html generated by yii\widgets\LinkPager widget.
 * @method static \stdClass pagination() returns yii\data\Pagination object.
 */
class News extends \yii\easyii\modules\news\models\News
{
}

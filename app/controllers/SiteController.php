<?php

namespace app\controllers;
use app\modules\shop\modules\admin\models\ProductSearch;
use Yii;
use yii\easyii\modules\article\models\Category;
use yii\easyii\modules\catalog\api\Catalog;
use yii\web\Controller;
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\news\models\News;
use app\modules\shop\models\Product;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\helpers\StringHelper;

class SiteController extends Controller
{
    const HOME_PAGE_SLUG = 'home';
    const ABOUT_PAGE_SLUG = 'about';

    public function behaviors(){
        return [
            'seo'=>'app\components\PageSeoBehavior',
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        Url::remember();

        $productsQuery = Product::find();

        $productsQuery->where(['is_bestseller' => true]);

        $productsDataProvider = new ActiveDataProvider([
            'query' => $productsQuery,
            'pagination' => [
                'pageSize' => 3,
            ],
        ]);
        return $this->render('index',[
            'productsDataProvider'=>$productsDataProvider,
            'homePage'=>Page::get(self::HOME_PAGE_SLUG),
            'aboutPage'=>Page::get(self::ABOUT_PAGE_SLUG),
        ]);
    }

    public function actionPage($slug)
    {
        $page = Page::get($slug);

        $this->setSeoText($page);

        return $this->render('page',['page'=>$page]);
    }

    public function actionFeedback()
    {
        return $this->render('feedback');
    }

    public function actionNews()
    {
        if($id = Yii::$app->request->getQueryParam('id')){
            $news = News::get($id);
            return $this->render('news-item',['news'=>$news]);
        }
        return $this->render('news');
    }

    public function actionRss()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find(),
            'pagination' => [
                'pageSize' => 10
            ],
        ]);

        $response = Yii::$app->getResponse();
        $headers = $response->getHeaders();

        $headers->set('Content-Type', 'application/rss+xml; charset=utf-8');

        $response->content = \Zelenin\yii\extensions\Rss\RssView::widget([
            'dataProvider' => $dataProvider,
            'channel' => [
                'title' => Yii::$app->name,
                'link' => Url::toRoute('/', true),
                'description' => 'Новости ',
                'language' => Yii::$app->language
            ],
            'items' => [
                'title' => function ($model, $widget) {
                    return $model->title;
                },
                'description' => function ($model, $widget) {
                    return StringHelper::truncateWords($model->short, 50);
                },
                'link' => function ($model, $widget) {
                    return Url::toRoute(['site/news', 'id' => $model->news_id], true);
                },
                'guid' => function ($model, $widget) {
                    return Url::toRoute(['site/news', 'id' => $model->news_id], true) . ' ' . date(DATE_RSS, $model->time);
                },
                'pubDate' => function ($model, $widget) {
                    return date(DATE_RSS, $model->time);
                }
            ]
        ]);
    }


}
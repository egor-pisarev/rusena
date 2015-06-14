<?php

namespace app\controllers;
use Yii;
use yii\easyii\models\Setting;
use yii\easyii\modules\article\models\Category;
use yii\web\Controller;
use yii\easyii\modules\page\api\Page;
use app\modules\news\models\News;
use app\modules\news\api\News as NewsApi;

use app\modules\shop\models\Product;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use app\models\ContactForm;

class SiteController extends Controller
{
    const HOME_PAGE_SLUG = 'home';
    const ABOUT_PAGE_SLUG = 'about';
    const CONTACT_PAGE_SLUG = 'contact';

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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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

        $page = Page::get(self::HOME_PAGE_SLUG);
        $this->setSeoText($page);

        return $this->render('index',[
            'productsDataProvider'=>$productsDataProvider,
            'page'=>$page,
        ]);
    }

    public function actionPage($slug)
    {
        $page = Page::get($slug);

        $this->setSeoText($page);

        return $this->render('page',['page'=>$page]);
    }

//    public function actionFeedback()
//    {
//        return $this->render('feedback');
//    }

    public function actionNews()
    {
        if($slug = Yii::$app->request->getQueryParam('slug')){
            $news = NewsApi::get($slug);
            return $this->render('news-item',['news'=>$news]);
        }

        $types = [1];
        if(!Yii::$app->user->isGuest){
            $types[] = 2;
        }
        return $this->render('news',['types'=>$types]);
    }

    public function actionRss()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->orderBy('time DESC'),
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

    /**
     * @return string|\yii\web\Response
     */
    public function actionFeedback()
    {
        $page = Page::get(self::CONTACT_PAGE_SLUG);

        $this->setSeoText($page);

        $model = new ContactForm();
        if (!$model->load(Yii::$app->request->post())){
            return $this->render('feedback', [
                'model' => $model,
                'page' => $page,
            ]);
        }
        $feedbackEmails = explode(',',Setting::get('feedback_emails'));
        if(!is_array($feedbackEmails)){
            $feedbackEmails = array($feedbackEmails);
        }
        $result = true;
        foreach($feedbackEmails as $feedbackEmail){
            $result = $result && $model->contact($feedbackEmail);
        }
        if($result) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->goBack();
        } else {
            return $this->render('feedback', [
                'model' => $model,
                'page' => $page,
            ]);
        }
    }



}
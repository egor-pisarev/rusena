<?php

namespace app\controllers;
use app\modules\shop\modules\admin\models\ProductSearch;
use Yii;
use yii\easyii\modules\article\models\Category;
use yii\easyii\modules\catalog\api\Catalog;
use yii\web\Controller;
use yii\easyii\modules\page\api\Page;
use yii\easyii\modules\news\api\News;
use app\modules\shop\models\Product;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class SiteController extends Controller
{
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
        return $this->render('index',['productsDataProvider'=>$productsDataProvider]);
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

    public function actionCatalog()
    {
        if($categorySlug = Yii::$app->request->getQueryParam('category')){
            if($itemSlug = Yii::$app->request->getQueryParam('item')){
                $item = Catalog::item($itemSlug);
                return $this->render('product',['item'=>$item]);
            }
            $category = Catalog::cat($categorySlug, ['pageSize' => 2]);
            return $this->render('category',['category'=>$category]);
        }

        return $this->render('catalog');
    }

    public function actionAddToCart($id)
    {
        $cart = new ShoppingCart();

        $model = Product::findOne($id);
        if ($model) {
            $cart->put($model, 1);
            return $this->redirect(['cart-view']);
        }
        throw new NotFoundHttpException();
    }


}
<?php

namespace app\modules\shop\controllers;

use app\modules\shop\modules\admin\models\ProductSearch;
use Yii;
use app\modules\shop\models\Category;
use app\modules\shop\models\Product;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\HttpException;
use yii\easyii\modules\page\api\Page;


class CatalogController extends \yii\web\Controller
{
    public function behaviors(){
        return [
            'seo'=>'app\components\PageSeoBehavior',
        ];
    }

    public function actionIndex()
    {

        $page = Page::get('catalog');

        $this->setSeoText($page);

        $categories = Category::find()->indexBy('id')->where(['parent_id'=>null])->orderBy('id')->all();

        return $this->render('index',['categories'=>$categories]);
    }

    public function actionList($slug = null)
    {
        Url::remember();

        $category = Category::findBySlug($slug);
        if(!$category){
            throw new HttpException(404,'Page not found');
        }

        $this->setSeoText($category);

        $dataProvider = new ActiveDataProvider([
            'query'=>Product::find()->where(['category_id'=>$category->id]),
        ]);

        return $this->render('list', [
            'category' => $category,
            'productsDataProvider' => $dataProvider,
        ]);
    }

    public function actionView($slug)
    {
        Url::remember();

        $model = Product::findBySlug($slug);

        $this->setSeoText($model);

        if(!$model){
            throw new HttpException(404,'Page not found');
        }
        return $this->render('view',['model'=>$model]);
    }

    public function actionSearch()
    {
        Url::remember();

        $searchModel = new ProductSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }




}

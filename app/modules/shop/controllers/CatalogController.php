<?php

namespace app\modules\shop\controllers;

use app\modules\shop\modules\admin\models\ProductSearch;
use Yii;
use app\modules\shop\models\Category;
use app\modules\shop\models\Product;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\HttpException;

class CatalogController extends \yii\web\Controller
{
    public function actionIndex()
    {
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
        $model = Product::findBySlug($slug);
        if(!$model){
            throw new HttpException(404,'Page not found');
        }
        return $this->render('view',['model'=>$model]);
    }





}

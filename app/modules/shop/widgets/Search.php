<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 02.06.15
 * Time: 16:04
 * To change this template use File | Settings | File Templates.
 */

namespace app\modules\shop\widgets;

use Yii;
use app\modules\shop\modules\admin\models\ProductSearch;
use yii\bootstrap\Widget;

class Search extends Widget{

    public function run(){
        $model = new ProductSearch();
        $model->load(Yii::$app->request->queryParams);
        return $this->render('search',['model'=>$model]);
    }

}
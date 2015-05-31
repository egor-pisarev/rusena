<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 29.05.15
 * Time: 20:38
 * To change this template use File | Settings | File Templates.
 */

namespace app\modules\shop\modules\admin\controllers;


use yii\web\Controller;

class DefaultController extends Controller {

    public function actionIndex()
    {
        return $this->render('index');
    }
}
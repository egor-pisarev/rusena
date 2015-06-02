<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 02.06.15
 * Time: 15:03
 * To change this template use File | Settings | File Templates.
 */
namespace app\components;

use Yii;
use yii\base\Behavior;

class PageSeoBehavior extends Behavior{

    public function setSeoText($page)
    {
        if(isset($page->seo_keywords) && isset($page->seo_description)){
            Yii::$app->view->registerMetaTag([
                'keywords'=>$page->seo_keywords,
                'description'=>$page->seo_description,
            ]);

            Yii::$app->view->title = $page->seo_title;
        }
    }
}
<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 30.05.15
 * Time: 10:25
 * To change this template use File | Settings | File Templates.
 */

namespace app\modules\shop\widgets;


use yii\bootstrap\Widget;
use app\modules\shop\models\Category;
use Yii;

class Catalog extends Widget{

    public function run()
    {
        $category = Yii::$app->request->getQueryParam('category');
        $categories = Category::find()->indexBy('id')->orderBy('id')->all();
        $items = $this->_getMenuItems($categories);
        return $this->render('catalog',['items'=>$items]);
    }

    /**
     * @param Category[] $categories
     * @param int $activeId
     * @param int $parent
     * @return array
     */
    private function _getMenuItems($categories, $activeId = null, $parent = null)
    {
        $menuItems = [];
        foreach ($categories as $category) {
            if ($category->parent_id === $parent) {
                $menuItems[$category->id] = [
                    'active' => $activeId === $category->id,
                    'label' => $category->title,
                    'url' => ['/shop/catalog/list', 'slug' => $category->slug],
                    'items' => $this->_getMenuItems($categories, $activeId, $category->id),
                ];
            }
        }
        return $menuItems;
    }
}
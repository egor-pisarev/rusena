<?php

namespace app\modules\shop\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use zxbodya\yii2\imageAttachment\ImageAttachmentBehavior;
use yii\easyii\behaviors\SeoBehavior;


/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $title
 * @property string $slug
 *
 * @property Category $parent
 * @property Category[] $categories
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'seo' => SeoBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug'
            ],
            'coverBehavior' => [
                'class' => ImageAttachmentBehavior::className(),
                'type' => 'category',
                // image dimmentions for preview in widget
                'previewHeight' => 200,
                'previewWidth' => 300,
                // extension for images saving
                'extension' => 'jpg',
                // path to location where to save images
                'directory' => Yii::getAlias('@webroot') . '/uploads/category',
                'url' => Yii::getAlias('@web') . '/uploads/category',
                // additional image versions
                'versions' => [
                    'small' => function ($img) {
                        /** @var ImageInterface $img */
                        return $img
                            ->copy()
                            ->resize($img->getSize()->widen(200));
                    },
                    'medium' => function ($img) {
                        /** @var ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 800;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                            ->copy()
                            ->resize($dstSize);
                    },
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'default', 'value' => null],
            [['parent_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родитель',
            'title' => 'Название',
            'slug' => 'Синоним',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }

    public static function findBySlug($slug)
    {
        return self::find()->where(['slug'=>$slug])->one();
    }
}

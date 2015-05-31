<?php

namespace app\modules\shop\models;;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property integer $product_id
 *
 * @property Product $product
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id'], 'number'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return string image hash
     */
    protected function getHash()
    {
        return md5($this->product_id . '-' . $this->id);
    }

    /**
     * @return string path to image file
     */
    public function getPath()
    {
        return Yii::getAlias('@webroot/uploads/product/' . $this->getHash() . '.jpg');
    }

    /**
     * @return string URL of the image
     */
    public function getUrl()
    {
        return Yii::getAlias('/uploads/product/' . $this->getHash() . '.jpg');
    }

    public function afterDelete()
    {
        if(is_file($this->getPath())){
            unlink($this->getPath());
        }
        parent::afterDelete();
    }
}

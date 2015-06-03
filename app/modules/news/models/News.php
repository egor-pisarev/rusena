<?php
namespace app\modules\news\models;

use Yii;
use yii\behaviors\SluggableBehavior;
use yii\easyii\behaviors\SeoBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;

class News extends \yii\easyii\components\ActiveRecord
{
    const TYPE_PUBLIC = 1;
    const TYPE_PROTECTED = 2;

    const STATUS_OFF = 0;
    const STATUS_ON = 1;

    public static function tableName()
    {
        return 'easyii_news';
    }

    public function rules()
    {
        return [
            [['text', 'title'], 'required'],
            [['title', 'short', 'text'], 'trim'],
            ['title', 'string', 'max' => 128],
            ['thumb', 'image'],
            ['time', 'default', 'value' => time()],
            ['views', 'number', 'integerOnly' => true],
            ['slug', 'match', 'pattern' => self::$SLUG_PATTERN, 'message' => Yii::t('easyii', 'Slug can contain only 0-9, a-z and "-" characters (max: 128).')],
            ['slug', 'default', 'value' => null],
            ['type', 'number', 'integerOnly' => true]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => Yii::t('easyii', 'Title'),
            'text' => Yii::t('easyii', 'Text'),
            'short' => Yii::t('easyii', 'Short'),
            'thumb' => Yii::t('easyii', 'Image'),
            'slug' => Yii::t('easyii', 'Slug'),
        ];
    }

    public function behaviors()
    {
        return [
            'seo' => SeoBehavior::className(),
            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'ensureUnique' => true
            ]
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $settings = Yii::$app->getModule('admin')->activeModules['protectednews']->settings;
            if($this->short && $settings['enableShort']){
                $this->short = StringHelper::truncate($this->short, $settings['shortMaxLength']);
            }

            return true;
        } else {
            return false;
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();

        if($this->thumb){
            @unlink(Yii::getAlias('@webroot').$this->thumb);
        }
    }

    public function getTypes()
    {
        return [
            self::TYPE_PROTECTED => 'Закрытые',
            self::TYPE_PUBLIC => 'Открытые',
        ];
    }
}
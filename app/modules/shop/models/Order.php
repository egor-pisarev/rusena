<?php

namespace app\modules\shop\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $phone
 * @property string $address
 * @property string $email
 * @property string $notes
 * @property string $status
 *
 * @property OrderItem[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 'New';
    const STATUS_IN_PROGRESS = 'In progress';
    const STATUS_DONE = 'Done';

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'email'], 'required'],
            [['notes'], 'string'],
            [['phone', 'email'], 'string', 'max' => 255],
            [['email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'email' => 'Email',
            'notes' => 'Заметка',
            'status' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->status = self::STATUS_NEW;
            }
            return true;
        } else {
            return false;
        }
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_DONE => 'Done',
            self::STATUS_IN_PROGRESS => 'In progress',
            self::STATUS_NEW => 'New',
        ];
    }

    public function sendEmail()
    {
        Yii::$app->mailer->htmlLayout='@shop/mail/layouts/html';
        return Yii::$app->mailer->compose('@shop/mail/order', ['order' => $this])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setSubject('New order #' . $this->id)
            ->send();
    }
}

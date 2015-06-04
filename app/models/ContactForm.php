<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject = 'Заявка с сайта';
    public $body;
    public $phone;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body', 'verifyCode'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            ['phone','string'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
	        'name' => 'Представьтесь',
	        'email' => 'Ваш email',
	        'subject' => 'Тема сообщения',
	        'body' => 'Сообщение',
            'phone'=>'Телефон',
            'verifyCode' => 'Введите код с картинки',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $emails the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($emails)
    {
	    if(!is_array($emails)){
		    $emails = array($emails);
	    }
        if ($this->validate()) {
	        foreach($emails as $email){
	            Yii::$app->mailer->compose()
	                ->setTo($email)
	                ->setFrom([$this->email => $this->name])
	                ->setSubject($this->subject)
	                ->setTextBody($this->body)
	                ->send();
	        }

            return true;
        } else {
            return false;
        }
    }
}

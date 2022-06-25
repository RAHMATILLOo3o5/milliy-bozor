<?php

namespace frontend\models;

use common\models\Contact;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $job;
    public $body;
    public $reCaptcha;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'job', 'body'], 'required'],
            // email has to be a valid email address
            ['job', 'string'],
            // verifyCode needs to be entered correctly
            [
                ['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator3::class,
                'secret' => '6LckYy0gAAAAAKWgAlSI4N5OCpM_hVkX3Zr4EGpY',
                'threshold' => 0.5,
                'action' => 'homepage',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Ismingiz'),
            'job' => Yii::t('app', 'Kasbingiz'),
            'body' => Yii::t('app', 'Fikringiz'),
            'reCaptcha' => Yii::t('app', 'Verification Code'),
        ];
    }

    public function save()
    {
        $model = new Contact();

        $model->name = $this->name;
        $model->job = $this->job;
        $model->body = $this->body;

        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
//    public function sendEmail($email)
//    {
//        return Yii::$app->mailer->compose()
//            ->setTo($email)
//            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
//            ->setReplyTo([$this->email => $this->name])
//            ->setSubject($this->subject)
//            ->setTextBody($this->body)
//            ->send();
//    }
}

<?php

namespace common\models;

use Yii;

/**
 * VerifyEmailForm
 */
class VerifyEmail extends \yii\base\Model
{
    /**
     * @property string email
     */
    public $email;
    public $captcha;


    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255, 'min' => 4],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('app', 'Bu Email band.')],

            [
                ['captcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::class,
                'secret' => '6Le6-qIgAAAAANFZM-kAkEtVe7G49Av1bFntmBJb',
                'uncheckedMessage' => 'Robot emasligingizni tasdiqlang.'
            ],
        ];
    }

    public function verifyEmail()
    {
        $user = new User();
        $user->email = $this->email;
        if (!$this->validate()) {
            return null;
        }
        $username = explode('@', $this->email);
        $user->username = $username[0];
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        Yii::$app->session->setFlash('success', Yii::t('app', 'Ro\'yhatdan o\'tganinggiz uchun rahmat! Tasdiqlash xabari elektron pochtangizga jo\'natdik. Bu bir oz vaqt olishi mumkin!'));
        return $this->sendEmail($user) && $user->save();
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

}

<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{

    public $username;
    public $email;
    public $password;
    public $province_id;
    public $tuman_id;
    public $phone;
    public $confirmPassword;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            ['username', 'trim'],
            ['username', 'required'],


            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],

            ['province_id', 'required'],
            ['province_id', 'integer'],

            ['tuman_id', 'required'],
            ['tuman_id', 'integer'],

            ['phone', 'required'],
            ['phone', 'string', 'max' => 200],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['confirmPassword', 'required'],
            ['confirmPassword', 'compare', 'compareAttribute' => 'password'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Foydalanuvchi nomi'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'confirmPassword' => Yii::t('app', 'Password tasdiqlash'),
            'province_id' => Yii::t('app', 'Viloyat*'),
            'tuman_id' => Yii::t('app', 'Tuman*'),
            'phone' => Yii::t('app', 'Telefon raqami*'),
        ];
    }

    public function getUser($id)
    {
        return User::findIdentity($id);
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = $this->getUser(Yii::$app->user->id);
        $user->setPassword($this->password);
        $user->tuman_id = $this->tuman_id;
        $user->province_id = $this->province_id;
        $user->phone = $this->phone;

        return $user->update();
    }


}

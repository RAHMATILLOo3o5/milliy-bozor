<?php

namespace frontend\controllers;

use backend\models\Banner;
use backend\models\Dayticket;
use backend\models\Monthticket;
use common\models\Contact;
use common\models\Product;
use common\models\Seen;
use common\models\TopTime;
use common\models\User;
use common\models\VerifyEmail;
use frontend\models\Offer;
use frontend\models\Policy;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\Section;
use frontend\models\Service;
use frontend\models\Terms;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\bootstrap4\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionChangeLang($lan)
    {
        $seen = new Seen();
        $seen->updated();
        Yii::$app->session->set('lan', $lan);
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $seen = new Seen();
            $seen->updated();
            $time = new TopTime();
            $time->check(Yii::$app->user->id);
        }

        $section = Section::find()->andWhere(['status' => 1])->limit(4)->all();
        $message = Contact::find()->andwhere(['status' => 1])->orderBy(['id' => SORT_DESC])->all();
        $topProduct = new ActiveDataProvider([
            'query' => Product::find()->andWhere(['status' => 1])->andWhere(['is_top' => 1])->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 9,
            ],
        ]);
        $newProduct = new ActiveDataProvider([
            'query' => Product::find()->andWhere(['status' => 1])->andWhere(['is_top' => 1])->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 9,
            ],
        ]);
        $oldProduct = new ActiveDataProvider([
            'query' => Product::find()->andWhere(['status' => 1])->andWhere(['is_top' => 1])->orderBy(['id' => SORT_ASC]),
            'pagination' => [
                'pageSize' => 9,
            ],
        ]);
        $banner = new ActiveDataProvider([
            'query' => Banner::find()->andWhere(['status' => 1])->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 9,
            ],

        ]);
        $offers = new ActiveDataProvider([
            'query' => Offer::find()->andWhere(['status' => 1])->asArray(),
            'pagination' => [
                'pageSize' => 4,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);
        $service = new ActiveDataProvider([
            'query' => Service::find()->andWhere(['status' => 1])->asArray(),
            'pagination' => [
                'pageSize' => 4,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
        ]);
        return $this->render('index', compact('section', 'message', 'banner', 'service', 'topProduct', 'newProduct', 'oldProduct', 'offers'));
    }

    /**
     * @return string
     */
    public function actionObuna()
    {
        $seen = new Seen();
        $seen->updated();
        $dticket = Dayticket::find()->where(['status' => 1])->all();
        $mticket = Monthticket::find()->where(['status' => 1])->all();
        return $this->render('obuna', compact('dticket', 'mticket'));
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            $seen = new Seen();
            $seen->updated();
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        $seen = new Seen();
        $seen->updated();

        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $seen = new Seen();
        $seen->updated();
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', Yii::t('app', 'O\'z fikringizni bildirganingiz uchun rahmat! Sizning fikringiz biz uchun muhim!')));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', Yii::t('app', 'Saqlashda xatolik yuz berdi! Iltimos qaytadan urinib ko\'ring!')));
            }

            return $this->redirect(['/product/index']);
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }


    public function actionUser()
    {
        $model = new SignupForm();
        $user = User::findIdentity(Yii::$app->user->id);
        $model->username = $user->username;
        $model->email = $user->email;
        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->signup() && Yii::$app->user->login($user, 3600 * 24 * 10)) {
                $seen = new Seen();
                $seen->saved();
                Yii::$app->session->setFlash('success', Yii::t('app', '"Milliy Bozor" ga Hush Kelibsiz! 🤗'));
                return $this->goBack();
            } else {
                $user->delete();
                Yii::$app->session->setFlash('danger', Yii::t('app', 'Nimadur xato ketdi. Qaytadan urnib ko\'ring!'));
                return $this->redirect(['site/signup']);
            }
        }
        return $this->render('user', compact('model'));
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new VerifyEmail();
        if ($this->request->isAjax && $model->load($this->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model, 'email');
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->verifyEmail()) {
                return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * @return string
     */
    public function actionTerm()
    {
        $model = Terms::find()->orderBy(['id' => SORT_DESC])->asArray()->one();
        $pol = Policy::find()->orderBy(['id' => SORT_DESC])->asArray()->one();
        return $this->render('term', [
            'term' => $model,
            'policy' => $pol
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Sizning elektron pochtangiz tasdiqlandi! Davom etishingiz mumkin!'));
            return $this->redirect(['user']);
        } else {
            $user->delete();
            Yii::$app->session->setFlash('error', Yii::t('app', 'Kechirasiz, taqdim etilgan token yordamida hisobingizni tasdiqlay olmaymadik.'));
            return $this->goHome();
        }

    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}

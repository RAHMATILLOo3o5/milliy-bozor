<?php

/** @var \yii\web\View $this */

/** @var string $content */

use common\widgets\Alert;
use frontend\models\Section;
use yii\bootstrap4\Html;

$section = Section::find()->andWhere(['status' => 1])->orderBy(['id' => SORT_DESC])->all();

\frontend\assets\MessageAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style>
            .form-control {
                box-shadow: none !important;
            }

        </style>
    </head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
            integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
            crossorigin="anonymous"></script>
    <body>
    <?php $this->beginBody() ?>
    <div class="container-fluid">
        <?= $this->render('header', ['section' => $section]) ?>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <?= Alert::widget([
                    'options' => ['class' => 'text-center']
                ]) ?>
            </div>
        </div>
        <?= $content ?>
        <?= $this->render('footer') ?>
    </div>


    <?php $this->endBody() ?>
    </body>

    </html>
<?php $this->endPage();

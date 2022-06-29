<?php

/** @var \yii\web\View $this */

/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\models\Section;
use yii\bootstrap4\Html;

$section = Section::find()->andWhere(['status' => 1])->orderBy(['id' => SORT_ASC])->all();

AppAsset::register($this);
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

<?php
$js = <<<JS
    $('#search-input').keyup(function() {
        var inpVal = $(this).val();
        var form = $('#parent');
      var searchResponse = $( "#search-response" );
      if (inpVal !== ''){
          searchResponse.css('width', form[0].clientWidth+'px')
          searchResponse.show("slow");
          $.ajax({
            url:form.attr('action'),
            type:"GET",
            data:{q: inpVal},
            success:function(data) {
              console.log(data);
            }
          });
      } else {
          searchResponse.hide("slow");
      }
    });
JS;
$this->registerJs($js);
?>
</body>

</html>
<?php $this->endPage(); ?>

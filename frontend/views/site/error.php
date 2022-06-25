<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */

/** @var Exception $exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<div class="row my-3">
    <div class="col-md-12 text-center">
        <img src="<?= Yii::getAlias('@defaultImgPath') ?>/01.gif" class="img-fluid h-75">
        <div class="row">
            <div class="col-md-12">
                <h1 class="display-4"><?= Html::encode($this->title) ?></h1>
                <p class="lead"><?= nl2br(Html::encode($message)) ?></p>
                <p class="lead">
                    <a href="<?= Url::home() ?>" class="btn btn-primary"><?= Yii::t('app', 'home') ?></a>
                </p>
            </div>
        </div>
    </div>
</div>

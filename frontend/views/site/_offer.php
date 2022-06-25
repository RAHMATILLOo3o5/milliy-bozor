<?php

use yii\helpers\Url;

/**
 * @var $model \frontend\models\Offer
 */
?>

<div class="card ">
    <img src="<?= Yii::getAlias('@getimg') . '/' . $model['img'] ?>" class="card-img" height="350px" alt="...">
    <div class="card-img-overlay">
        <h3 class="card-title"><?= $model['title_' . Yii::$app->language] ?></h3>
        <p class="card-text">
            <?= $model['content_' . Yii::$app->language] ?>
        </p>
        <p class="card-text"><span
                    class="text-danger"><?= number_format($model['price'], '0', ' ', ' ') ?> sum</span>
            <small class="sale"><?= number_format($model['sale'], '0', ' ', ' ') ?> sum</small>
        </p>
        <a href="<?= Url::to(['/offer/view-offer', 'id' => $model['id']]) ?>"
           class="btn btn-danger"><?= Yii::t('app', 'olish') ?></a>
    </div>
</div>

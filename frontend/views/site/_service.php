<?php

use yii\helpers\StringHelper;
use yii\helpers\Url;

/**
 * @var $model \frontend\models\Service
 */
?>


<div class="card rounded">
    <img src="<?= Yii::getAlias('@getimg') . '/' . $model['img'] ?>" class="card-img rounded" alt="..." height="350px">
    <div class="card-img-overlay text-white pt-5">
        <div class="mt-5">
            <span class="btn btn-danger"><?= $model['title_' . Yii::$app->language] ?></span>
            <span><?= date('d M Y', $model['created_at']) ?></span>
            <h3 class="card-title"><?= StringHelper::truncateWords($model['content_' . Yii::$app->language], 3) ?></h3>
            <p class="card-link"><a href="<?= Url::to(['/offer/view-service', 'id' => $model['id']]) ?>"><?= Yii::t('app', 'Batafsil') ?></a></p>
        </div>
    </div>
</div>
<?php

use common\models\Like;
use yii\helpers\Url;

/**
 * @var $id integer
 *
 */
?>

<a href="<?= Url::to(['/site/like', 'id' => $id]) ?>" data-method="post" data-pjax="1" class="card-link">
    <i class="fa fa-heart ml-lg-5
    <?php
    if (!Yii::$app->user->isGuest && Like::findOne(
            [
                'product_id' => $id,
                'user_id' => Yii::$app->user->id
            ]
        )) {
        echo 'active';
    } else {
        echo '';
    }
    ?>">
    </i>
</a>
<?php

/**
 * @var \yii\web\View $this
 * @var \common\models\SearchLike $model
 */

use yii\helpers\Url;

?>

<div class="alert alert-info" role="alert">
    <div class="row">
        <div class="col-md-6">
            <?= Yii::t('app', 'Qiridilgan so\'z: ') ?> <b><a
                        href="<?= Url::to(['product/index', 'q' => $model->query]) ?>"><?= $model->query ?></a></b>
            <p class="p-0 m-0"><?= Yii::t('app', 'Natijalar soni: ') . $model->product ?></p>
        </div>
        <div class="col-md-6">
            <a href="<?= Url::to(['component/delete-search', 'id'=>$model->id]) ?>" class="close" >
                <span aria-hidden="true">&times;</span>
            </a>
        </div>
    </div>

</div>

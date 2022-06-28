<?php
/**
 * @var $users \common\models\User
 */

use yii\widgets\ListView;

echo ListView::widget([
    'dataProvider' => $users,
    'itemView' => '_users',
    'layout' => "{items}\n{pager}",
    'options' => [
        'class' => 'row mt-md-4'
    ],
    'emptyText' => '<div class="col-lg-8 text-center py-sm-5 offset-lg-2">
               <img src="' . Yii::getAlias('@defaultImgPath') . '/undraw_inspiration_lecl 1.svg" alt="">
                  <h3 class="my-sm-5">' . Yii::t('app', 'E\'lonlar topilmadi') . '😥</h3>
           </div>',
    'itemOptions' => [
        'class' => 'col-md-4 p-md-5 my-1 px-5'
    ],
    'pager' => [
        'class' => \yii\bootstrap4\LinkPager::class,
        'maxButtonCount' => 8,
        'options' => [
            'class' => 'col-12 pl-5 mt-4'
        ]
    ]
]);


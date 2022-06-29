<?php

use frontend\models\Footer;
use yii\helpers\Url;

$icon = Footer::find()->where(['status' => 1])->one();
$footer = Footer::find()->where(['id' => $icon->id])->asArray()->one();

?>
<div class="danger p-4 "></div>
<div class="footer my-sm-5">
    <div class="px-lg-6">
        <div class="row mb-4">
            <div class="col-md-3">
                <a href="<?= Url::home() ?>"><img src="<?= Yii::getAlias('@defaultImgPath') ?>/Component 1.svg"
                                                  alt="logo" class="my-2 w-50"></a>
                <p><?= $footer['text_' . Yii::$app->language] ?></p>
                <div class="footer-icons">
                    <?= $icon->contact ?>
                </div>
            </div>
            <div class="col-md-3">
                <h5 class="font-weight-bold text-black-50 my-3 mx-4 mt-5"><?= Yii::t('app', 'Yordam') ?></h5>
                <ul class="list-unstyled mx-4 footer-bar">
                    <li>
                        <a href="<?= Url::to(['/site/term']) ?>#v-pills-profile"><?= Yii::t('app', 'Maxfiylik siyosati') ?></a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/site/dostavka']) ?>"><?= Yii::t('app', 'Yetkazib berish') ?></a>
                    </li>
                    <li>
                        <a href="#"><?= Yii::t('app', 'To\'lovni qaytarish') ?></a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/product/new-product']) ?>"><?= Yii::t('app', 'Mahsulotingizni yuklang') ?></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 class="font-weight-bold text-black-50 my-3 mx-4 mt-5"><?= Yii::t('app', 'Do\'kon') ?></h5>
                <ul class="list-unstyled mx-4 footer-bar">
                    <li>
                        <a href="<?= Url::to(['/product/index']) ?>"><?= Yii::t('app', 'Mebellar') ?></a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/product/index']) ?>"><?= Yii::t('app', 'Stollar') ?></a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/product/index']) ?>"><?= Yii::t('app', 'Boshqalar') ?></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 class="font-weight-bold text-black-50 my-3 mx-4 mt-5"><?= Yii::t('app', 'Qo\'llab-quvvatlash') ?></h5>
                <ul class="list-unstyled mx-4 footer-bar">
                    <li>
                        <a href="<?= Url::to(['/site/contact']) ?>"><?= Yii::t('app', 'Fikr-mulohaza') ?></a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/site/contact']) ?>"><?= Yii::t('app', 'Biz bilan aloqa') ?></a>
                    </li>
                    <li>
                        <a href="#"><?= Yii::t('app', 'Ilovalar') ?></a>
                    </li>
                    <li>
                        <a href="<?= Url::to(['/site/term']) ?>"><?= Yii::t('app', 'Foydalanish shartlari') ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p style="color: #5a5658">© 2022 Milliy Bozor - All rights reserved. Powered by <a href="https://t.me/Rahmatillo_2oo5" target="_blank">Rahmatillo Husanboyev</a></p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>

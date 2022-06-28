<?php

use yii\helpers\VarDumper;

$this->title = "Milliy Bozor - " . Yii::t('app', 'Fodalanish shartlari');


// VarDumper::dump($term, 10, true);
?>

<div class="px-lg-6 my-5">
    <div class="row">
        <div class="col-10 p-3  offset-1">
            <div class="row">
                <div class="col-3">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                            <?= Yii::t('app', 'Foydalanish shartlari'); ?>
                        </a>
                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            <?= Yii::t('app', 'Maxfiylik siyosati'); ?>
                        </a>
                    </div>
                </div>
                <div class="col-9">
                    <?php if ($term && $policy) :  ?>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="col-12 mb-5">
                                <?= Yii::t('app', 'Oxirgi yangilash: ');
                                echo  Yii::$app->formatter->asRelativeTime($term['updated_at']) ?>
                            </div>
                            <?= $term['content_' . Yii::$app->language] ?>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <div class="col-12 mb-5">
                                <?= Yii::t('app', 'Oxirgi yangilash: ');
                                echo  Yii::$app->formatter->asRelativeTime($policy['updated_at']) ?>
                            </div>
                            <?= $policy['content_' . Yii::$app->language] ?>
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>
</div>
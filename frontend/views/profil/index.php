<?php
/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Profil - ') . Yii::$app->name;
?>
<div class="danger">
    <div class="px-lg-6">
        <div class="row">
            <div class="col">
                <h3 class="py-5"><?= Yii::t('app', 'Saralangan e\'lonlar') ?></h3>
                <nav>
                    <div class="nav nav-tabs" id="profil" role="tablist">
                        <a class="nav-link active" id="like-tab" data-toggle="tab" href="#like" role="tab" aria-controls="like" aria-selected="true">
                            <b><?= Yii::t('app', 'Saralangan e\'lonlar') ?></b> <span class="badge badge-warning"><? //= $like_count ?></span>
                        </a>
                        <a class="nav-link" id="search-tab" data-toggle="tab" href="#search" role="tab" aria-controls="search" aria-selected="false">
                            <b><?= Yii::t('app', 'Saralangan qidiruv natijalari') ?></b> <span class="badge badge-warning"> 0</span>
                        </a>
                        <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">
                            <b><?= Yii::t('app', 'Yaqinda ko\'rilgan') ?></b> <span class="badge badge-warning"><? //= $view_count ?></span>
                        </a>
                        <a class="nav-link" id="nav-elon-tab" data-toggle="tab" href="#nav-elon" role="tab" aria-controls="nav-elon" aria-selected="false">
                            <b><?= Yii::t('app', 'E\'lonlarim') ?></b> <span class="badge badge-warning"><? //= $myads ?></span>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="px-lg-6">

</div>
<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = $service['title_' . Yii::$app->language] . " - Milliy Bozor";
?>
<style>
    .date {
        font-size: 11px
    }

    .comment-text {
        font-size: 14px
    }

    .fs-12 {
        font-size: 12px
    }

    .shadow-none {
        box-shadow: none
    }

    .name {
        color: #007bff
    }

    .cursor:hover {
        color: blue
    }
    
    .cursor {
        cursor: pointer
    }

    .textarea {
        resize: none;
        width: 100% !important;
    }
    .field-offercoment-content {
        width: 100% !important;

    }
</style>
<div class="px-lg-6">
    <div class="row my-4">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-3">
                <img class="card-img-top" src="<?= Yii::getAlias('@getimg') . '/' . $service['img'] ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $service['title_' . Yii::$app->language] ?></h4>
                        <p class="card-text"><?= $service['content_' . Yii::$app->language] ?></p>
                        <p class="card-text"><small class="text-muted"><?= Yii::$app->formatter->asRelativeTime($service['created_at']) ?></small></p>
                </div>
            </div>
            <div class="card">
                <div class="d-flex justify-content-center row">
                    <div class="col-md-10">
                        <div class="d-flex flex-column comment-section">
                            <?php if ($allComent) :
                                foreach ($allComent as $c) : ?>
                                    <div class="bg-white p-2">
                                        <div class="d-flex flex-row user-info">
                                            <i class="fa fa-user mt-2" style="font-size: 24px;"></i>
                                            <div class="d-flex flex-column justify-content-start ml-2">
                                                <span class="d-block font-weight-bold name"><?= $c->user->username ?></span>
                                                <span class="date text-black-50"><?= Yii::$app->formatter->asRelativeTime($c->created_at) ?></span>
                                            </div>
                                        </div>
                                        <div class="mt-2 ml-3">
                                            <p class="comment-text"><?= $c->content ?></p>
                                        </div>
                                    </div>
                                <?php endforeach;
                            else :  ?>
                            <?php endif; ?>
                            <?php $form = ActiveForm::begin()  ?>
                            <div class="bg-light p-2">
                                <div class="d-flex flex-row align-items-start p-3">
                                    <?= $form->field($coment, 'content')->textarea(['placeholder' => Yii::t('app', 'Koment qoldirish'), 'rows' => 4, 'class' => 'form-control ml-1 w-100 shadow-none textarea'])->label(false) ?>
                                </div>
                                <div class="mt-2 text-right">
                                    <button class="btn btn-primary btn-sm shadow-none" type="submit"><?= Yii::t('app', 'Koment qoldirish') ?></button>
                                    <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" type="reset"><?= Yii::t('app', 'Bekor qilish'); ?></button>
                                </div>
                            </div>
                            <?php ActiveForm::end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
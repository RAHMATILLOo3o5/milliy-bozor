<?php

use yii\helpers\Url;


$this->title = Yii::t('app', 'Yetkazib berish') . ' - ' . Yii::$app->name;
?>
<div class="px-lg-6 my-sm-5">
  <div class="row">
    <div class="col-md-4 text-center">
      <img src="<?= Url::base() ?>/images/undraw_deliveries_2r4y 1.png" class="img-fluid">
      <img src="<?= Url::base() ?>/images/Frame 45.png" class="img-fluid my-5">
    </div>
    <div class="col-md-4">
      <?php if ($content) : foreach ($content as $k) : ?>

          <h4><b><?= $k['title_' . Yii::$app->language] ?></b></h4>
          <p>
            <?= $k['description_' . Yii::$app->language] ?>
          </p>

        <?php endforeach;
      else : ?>
        <h4><b>24/7 ALOQA</b></h4>
        <p>
          Jo'natmangiz qayerdaligi va qancha muddatda yetib
          borishini kunning istalgan paytida aniqlashingiz va nazorat
          qilishingiz mumkin.
        </p>

        <div class="mt-5">
          <h4><b>XIZMATLARIMIZ AFZALLIKLARI</b></h4>
          <p>
            mijozning xohishi asosida u turgan hududga yetkazib
            berish;

            mijozning vaqtida qarab yetkazib berish;

            mijozning istagi bo’yicha (oluvchi yoki jo’natuvchi) to’lov
            turini amalga oshirish;

            24 soat ichida Respublika viloyat markazlarigacha
            yetkazish;
          </p>
        </div>
      <?php endif; ?>
    </div>
    <div class="col-md-4 text-center">
      <img src="<?= Url::base() ?>/images/Frame 44.png" class="img-fluid my-5">
      <img src="<?= Url::base() ?>/images/undraw_details_8k13 1.png" class="img-fluid">
    </div>
  </div>
  <div class="danger rounded my-sm-5 p-sm-5">
    <div class="row">
      <div class="col-sm-6 p-4 text-uppercase">
        <h3><?= Yii::t('app', 'Jo\'natmalarni yetkazib berish'); ?></h3>
      </div>
      <div class="col-sm-6 text-right p-4">
        <?php if ($connect) : foreach ($connect as $r) : ?>
            <h3>
              <?= $r->phone ?>
            </h3>
        <?php endforeach;
        endif; ?>
      </div>
    </div>
  </div>
</div>
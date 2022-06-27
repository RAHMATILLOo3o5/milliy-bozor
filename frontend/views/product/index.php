<?php

/**
 * @var $product \yii\data\ActiveDataProvider
 */

use yii\widgets\ListView;

$this->title = Yii::t('app', 'Barcha E\'lonlar') . ' - Milliy Bozor';

?>

<div class="body px-lg-6 my-sm-5">
    <div class="row mt-lg-3">
        <div class="col-lg-2">
            <label for="caty" class="font-weight-bolder">Rukn:</label>
            <select name="" class="form-control get-category" id="caty">
                <option value="">Elektr jihozlari</option>
                <option value="">Elektr jihozlari</option>
                <option value="">Elektr jihozlari</option>
                <option value="">Elektr jihozlari</option>
            </select>
        </div>
        <div class="col-lg-4">
            <label for="price" class="font-weight-bolder">Narxi:</label>
            <div class="d-flex">
                <input type="text" class="form-control price" id="price" placeholder="dan"/>
                <input type="text" class="form-control price ml-md-3" placeholder="..."/>
            </div>
        </div>
        <div class="col-lg-2">
            <label for="viloyat" class="font-weight-bolder">Viloyat:</label>
            <select name="" class="form-control get-category" id="viloyat">
                <option value="">Andijon</option>
                <option value="">Farg'ona</option>
                <option value="">Namangan</option>
                <option value="">Toshkent</option>
            </select>
        </div>
        <div class="col-lg-4 px-lg-5">
            <div class="form-group">
                <label for="sort" class="font-weight-bolder">Saralash:</label>
                <select name="" class="form-control get-category" id="sort">
                    <option value=""></option>
                    <option value=""><?= $product->sort->link('id') ?></option>
                    <option value="">Qimmat</option>
                    <option value="">Eski</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row mt-lg-1 d-none d-md-flex">
        <div class="col">
            <div class="sorts d-lg-flex justify-content-lg-around">
                <a href="#" class="font-weight-bolder active">Telefonlar <i class="fa fa-sort-down"></i>
                </a>
                <a href="#" class="font-weight-bolder">Audio texnika <i class="fa fa-sort-down"></i></a>
                <a href="#" class="font-weight-bolder">Maishiy texnika <i class="fa fa-sort-down"></i></a>
                <a href="#" class="font-weight-bolder">Yakka Qarov <i class="fa fa-sort-down"></i></a>
                <a href="#" class="font-weight-bolder">Iqlim qurilmalari <i class="fa fa-sort-down"></i></a>
                <a href="#" class="font-weight-bolder">Kompyuterlar <i class="fa fa-sort-down"></i></a>
                <a href="#" class="font-weight-bolder">O'yin anjomlari<i class="fa fa-sort-down"></i></a>
            </div>
        </div>
    </div>
    <div class="row mt-lg-1 d-none d-md-flex">
        <div class="col">
            <div class="sorts d-lg-flex justify-content-lg-around">
                <a href="#" class="font-weight-bolder">Telefonlar <i class="fa fa-sort-down"></i>
                </a>
                <a href="#" class="font-weight-bolder">Audio texnika <i class="fa fa-sort-down"></i></a>
                <a href="#" class="font-weight-bolder">Maishiy texnika <i class="fa fa-sort-down"></i></a>
                <a href="#" class="font-weight-bolder">Yakka Qarov <i class="fa fa-sort-down"></i></a>
                <a href="#" class="font-weight-bolder">Iqlim qurilmalari <i class="fa fa-sort-down"></i></a>
                <a href="#" class="font-weight-bolder">Kompyuterlar <i class="fa fa-sort-down"></i></a>
                <a href="#" class="font-weight-bolder">Boshqa elektronika</a>
            </div>
        </div>
    </div>

    <div class="row mt-md-4">
        <div class="col sorts">
            <a href="#"><b>Uy va Bog' <span class="text-danger">12 </span></b>
            </a>
            <a href="#"><b>Elektr jihozlari' <span class="text-danger">122 </span></b>
            </a>
            <a href="#"><b>Elektronika <span class="text-danger">142 </span></b>
            </a>
        </div>
    </div>
    <?= $product->sort->link('id') ?>
    <?=
    ListView::widget([
        'dataProvider' => $product,
        'itemView' => '_items',
        'layout' => "{items}\n{pager}",
        'options' => [
            'class' => 'row mt-md-4'
        ],
        'itemOptions' => [
            'class' => 'col-md-4 p-md-5'
        ],
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class,
            'maxButtonCount'=>8,
            'options' => [
                'class'=>'col-12 pl-5 mt-4'
            ]
        ]
    ]);
    ?>

</div>

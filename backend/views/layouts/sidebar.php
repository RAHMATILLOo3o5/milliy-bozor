<?php

use backend\models\Dayticket;
use yii\helpers\Url;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::home() ?>" class="brand-link">
        <img src="<?= Yii::getAlias('@defaultImgPath') ?>/Logo.jpg" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?= Yii::$app->name ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= Yii::getAlias('@defaultImgPath') ?>/user.png" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= Yii::$app->user->identity->username ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Dashboard',
                        'icon' => 'tachometer-alt',
                        'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Asosiy', 'url' => ['site/index'], 'iconStyle' => 'far'],
                        ]
                    ],
                    ['label' => 'OBUNALAR', 'header' => true],
                    ['label' => 'Kunlik obunalar', 'url' => ['dayticket/index'], 'icon' => 'clipboard'],
                    ['label' => 'Oylik obunalar', 'url' => ['monthticket/index'], 'icon' => 'moon'],
                    ['label' => 'MAHSULOTLAR', 'header' => true],
                    ['label' => 'Bo\'limalar', 'url' => ['section/index'], 'icon' => 'layer-group'],
                    ['label' => 'Kategoriyalar', 'url' => ['category/index'], 'icon' => 'th-large'],
                    ['label' => 'E\'lonlar', 'url' => ['product/index'], 'icon' => 'bullhorn'],
                    ['label' => 'Maxsus takliflar', 'url' => ['offer/index'], 'icon' => 'coffee'],
                    ['label' => 'Qo\'shimcha xizmatlar', 'url' => ['service/index'], 'icon' => 'calculator'],
                    ['label' => 'SAYT SOZLAMARI', 'header' => true],
                    ['label' => 'Banner', 'url' => ['banner/index'], 'icon' => 'image'],
                    ['label' => 'Pastki qism', 'url' => ['footer/index'], 'icon' => 'arrow-down'],
                    ['label' => 'Foydalanish shartlari', 'url' => ['site/term'], 'icon' => 'users'],
                    ['label' => 'Maxfiylik siyosati', 'url' => ['site/policy'], 'iconStyle'=>'fas', 'icon' => 'hand-point-up']
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

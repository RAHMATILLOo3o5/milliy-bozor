<?php

use common\models\Contact;
use yii\helpers\Html;
use yii\helpers\Url;

$messages = Contact::findAll(['read' => 0]);
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= \yii\helpers\Url::home() ?>" class="nav-link">Asosiy</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= Url::to(['contact/index']) ?>" class="nav-link">Xabarlar</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="https://milliy-bozor.com" target="_blank" class="nav-link">Saytni ko'rish</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <?= (Contact::find()->where(['read' => 0])->count() != 0) ? "<span class='badge badge-danger navbar-badge'>" . Contact::find()->where(['status' => 0])->count() . "</span>" : '' ?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                <?php if ($messages) :
                    foreach ($messages as $k) : ?>
                        <a href="<?= Url::to(['/contact/view', 'id' => $k->id]) ?>" class="dropdown-item">
                            <div class="media">
                                <img src="<?= Yii::getAlias('@defaultImgPath') ?>/user.png" alt="User Avatar"
                                     class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        <?= $k->name ?>
                                    </h3>
                                    <p class="text-sm"><?= $k->shortText ?></p>
                                    <p class="text-sm text-muted"><i
                                                class="far fa-clock mr-1"></i> <?= Yii::$app->formatter->asRelativeTime($k->created_at); ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    <?php endforeach;

                    echo "<a href='" . Url::to(['/contact/index']) . "' class='dropdown-item dropdown-footer'> Barcha xabarlar</a>";

                else : ?>
                    <a href="#" class="dropdown-item dropdown-footer text-warning">Xabarlar yo'q</a>
                <?php endif; ?>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link text-danger']) ?>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

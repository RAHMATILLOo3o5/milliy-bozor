<?php

use yii\bootstrap4\Html;
use yii\helpers\Url;

/**
 *
 * @var $section \frontend\models\Section
 */
$lan = Yii::$app->params['language'];
?>
<style>
    .categories {
        width: 200px !important;
        height: 50px !important;
    }

    @media (max-width: 950px) {
        .rounded {
            border: none !important;
        }
    }

    @media (max-width: 586px) {
        .rounded {
            border-radius: 0 !important;
            border: none !important;
        }
    }

    #search-input {
        position: relative !important;
    }

    .myStyle {
        position: absolute !important;
        z-index: 4;
    }
</style>

<div class="header shadow-sm">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <nav class="navbar navbar-expand-lg navbar-white bg-white">
                <a class="navbar-brand" href="<?= Url::home() ?>">
                    <img src="<?= Yii::getAlias('@defaultImgPath') ?>/Component 1.svg" alt="logo"/>
                </a>
                <div class="nav-item d-inline-block d-lg-none profile">
                    <a href="<?= Url::to(['/profil/index']) ?>"
                       class="nav-link navbar-text <?= (Yii::$app->controller->route == '/profil/index') ? 'active' : ''; ?>">
                        <i class="fa fa-user"></i><?= Yii::t('app', 'profil') ?></a>
                    <?php if (!empty(Yii::$app->user->identity->password_hash)) : ?>
                        <div class="dropdown_prof">
                            <div class="header">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <div class="id">
                                    <p class="title"><?= Yii::$app->user->identity->shortName ?></p>
                                    <div class="subtitle">id: <?= Yii::$app->user->id ?></div>
                                </div>
                            </div>
                            <ul class="drop_menu">
                                <li>
                                    <a href="<?= Url::to(['/profil/']) ?>">
                                        <?= Yii::t('app', 'saralangan') ?>
                                        <span class="badge badge-success"></span>
                                    </a>
                                </li>
                                <li>
                                    <?php
                                    echo Html::a(Yii::t('app', 'all') . '<i class="fa-solid fa-crown ml-1"></i>', Url::to(['/product/']));
                                    ?>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/message/index']) ?>"><?= Yii::t('app', 'xabar') ?> </a>
                                </li>
                                <li>
                                    <a href="<?= Url::to(['/site/dostavka']) ?>"><?= Yii::t('app', 'dostavka') ?></a>
                                </li>
                                <li><a href="<?= Url::to(['setting/index']) ?>"><?= Yii::t('app', 'sozlama') ?></a>
                                </li>

                                <li>
                                    <?php
                                    echo Html::a(Yii::t('app', 'pro'), Url::to(['/top/premium']));
                                    ?>
                                </li>
                                <li><a href="<?= Url::to(['/site/logout']) ?>" data-method="post"
                                       class="back"><?= Yii::t('app', 'chiqish') ?></a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?= Url::home() ?>"
                               class="nav-link navbar-text <?= (Yii::$app->controller->route == 'site/index' || Yii::$app->controller->route == '/') ? 'active' : ''; ?>"><?= Yii::t('app', 'home') ?></a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= Url::to(['/site/obuna']) ?>"
                               class="nav-link navbar-text <?= (Yii::$app->controller->route == 'site/obuna') ? 'active' : ''; ?>"><?= Yii::t('app', 'narx') ?></a>
                        </li>
                        <li class="nav-item profile d-none d-md-flex">
                            <a href="<?= Url::to(['/profil/index']) ?>"
                               class="nav-link navbar-text <?= (Yii::$app->controller->route == '/profil/index') ? 'active' : ''; ?>">
                                <i class="fa fa-user"></i> <?= Yii::t('app', 'profil') ?>
                            </a>
                            <?php if (!empty(Yii::$app->user->identity->password_hash)) : ?>
                                <div class="dropdown_prof">
                                    <div class="header">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <div class="id">
                                            <p class="title"><?= Yii::$app->user->identity->shortName ?></p>
                                            <div class="subtitle">id: <?= Yii::$app->user->id ?></div>
                                        </div>
                                    </div>
                                    <ul class="drop_menu">
                                        <li>
                                            <a href="<?= Url::to(['/profil/']) ?>">
                                                <?= Yii::t('app', 'saralangan') ?>
                                                <span class="badge badge-light"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <?php
                                            echo Html::a(Yii::t('app', 'all'), Url::to(['/product/']));
                                            ?>
                                        </li>
                                        <li>
                                            <a href="<?= Url::to(['/message/index']) ?>"><?= Yii::t('app', 'xabar') ?> </a>
                                        </li>
                                        <li>
                                            <a href="<?= Url::to(['/site/dostavka']) ?>"><?= Yii::t('app', 'dostavka') ?></a>
                                        </li>
                                        <li>
                                            <a href="<?= Url::to(['/setting/index']) ?>"><?= Yii::t('app', 'sozlama') ?></a>
                                        </li>

                                        <li>
                                            <?php
                                            echo Html::a(Yii::t('app', 'pro'), Url::to(['/top/premium']));
                                            ?>
                                        </li>
                                        <li><a href="<?= Url::to(['/site/logout']) ?>" data-method="post"
                                               class="back"><?= Yii::t('app', 'chiqish') ?></a></li>
                                    </ul>
                                </div>
                            <?php endif; ?>

                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-dark d-none d-lg-inline">
                                <i class="fa-solid fa-bars"></i></a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Url::to(['/product/new-product']) ?>"
                               class="btn btn-danger font-weight-bolder">
                                <?= Yii::t('app', 'E\'lon berish') ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories mb-lg-3 d-none d-lg-flex">
                        <img class="categorie_icon" src="<?= Yii::getAlias('@defaultImgPath') ?>/toifa.svg" alt=""/>
                        <p class="categorie"><?= Yii::t('app', 'Toifalar') ?></p>
                        <div class="dropdown_categories">
                            <?php
                            if ($section) {
                                if (Yii::$app->language == 'uz') {
                                    foreach ($section as $sect) {
                                        echo '<a href="' . Url::to(['/product/', 'section' => $sect->id]) . '">
                                              <img src="' . Yii::getAlias('@getimg') . '/' . $sect->img . '" alt=""/>
                                              ' . $sect->name_uz . '
                                           </a>';
                                    }
                                } else {
                                    foreach ($section as $sect) {
                                        echo '<a href="' . Url::to(['/product/', 'section' => $sect->id]) . '">
                                              <img src="' . Yii::getAlias('@getimg') . '/' . $sect->img . '" alt=""/>
                                              ' . $sect->name_ru . '
                                           </a>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="category d-flex justify-content-start justify-content-lg-center d-lg-none">
                        <?php
                        if ($section) {
                            if (Yii::$app->language == 'uz') {
                                foreach ($section as $sect) {
                                    echo '<a href="' . Url::to(['/product/', 'section' => $sect->id]) . '">
                                              <img src="' . Yii::getAlias('@getimg') . '/' . $sect->img . '" class="rounded-img"/>
                                              ' . $sect->name_uz . '
                                           </a>';
                                }
                            } else {
                                foreach ($section as $sect) {
                                    echo '<a href="' . Url::to(['/product/', 'section' => $sect->id]) . '">
                                              <img src="' . Yii::getAlias('@getimg') . '/' . $sect->img . '" class="rounded-img"/>
                                              ' . $sect->name_ru . '
                                           </a>';
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-3 ml-lg m-0">
                    <div class="mt-lg-3 my-3">
                        <form method="get" id="parent" action="<?= Url::to(['product/search']) ?>">
                            <div class="input-group-search">
                                <i class="fa fa-search"></i>
                                <input type="text" name="q" class="form-input" id="search-input" autocomplete="off"
                                       placeholder="<?= Yii::t('app', 'Qidirish...') ?>"/>
                            </div>
                        </form>
                        <div class="list-group list-group-flush shadow myStyle" style="display: none"
                             id="search-response">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="language mt-lg-3 text-center text-lg-left">
                        <a href="<?= Url::to(['/site/change-lang', 'lan' => strtolower($lan['uz'])]) ?>"
                           class="<?= (!Yii::$app->session->has('lan') || Yii::$app->session->get('lan') == strtolower($lan['uz'])) ? 'active' : '' ?>">
                            <?= $lan['uz'] ?>
                        </a>
                        <span>|</span>
                        <a href="<?= Url::to(['/site/change-lang', 'lan' => strtolower($lan['ru'])]) ?>"
                           class="<?= (Yii::$app->session->get('lan') == strtolower($lan['ru'])) ? 'active' : '' ?>">
                            <?= $lan['ru'] ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


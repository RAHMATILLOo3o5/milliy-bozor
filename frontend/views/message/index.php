<?php

/**
 * @var $this \yii\web\View
 * @var $messages \common\models\Message[]
 */

use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Xabarlarim') . ' - Milliy Bozor';
?>

<style>
    .chat-info {
        background-color: #F21515 !important;
    }

    .chat-list_rooms {
        border: none !important;
        height: 400px !important;
    }

    .chat-list_rooms a {
        color: #0c0c0d !important;
        text-decoration: none !important;
    }

    .chat-list_rooms a .chat-list_content {
        transition: all 0.3s ease-in-out;
    }

    .chat-list_rooms a .chat-list_content:hover {
        color: #fffacd !important;
        text-decoration: none !important;
        background: #ff1c1c !important;
    }

    .chat-list_rooms a .active {
        color: #fffacd !important;
        text-decoration: none !important;
        background: #ff1c1c !important;
    }

    .chat-column-left .chat-profile {
        background-color: #F21515 !important;
    }

    .chat-message {
        height: 410px !important;
    }

    .chat-form {
        border: none !important;
    }
</style>
<div class="px-lg-6 mt-2 mb-5">
    <div class="chat-index">
        <div class="chat-column-left">
            <div class="chat-list">
                <form class="form-inline active-pink-3 my-2 active-pink-4">
                    <input class="form-control form-control-sm ml-3 w-75 border-0" type="text" placeholder="Search"
                           aria-label="Search">
                    <i class="fas fa-search" aria-hidden="true"></i>
                </form>
                <div class="chat-list_rooms">
                    <?php if ($messages) : foreach ($messages as $message) : if ($message->to == Yii::$app->user->id) : ?>
                        <a href="<?= Url::to(['message/select', 'id' => $message->message->chat_id]) ?>"
                           class="select_user">
                            <div class="chat-list_content">
                                <div class="avatar text-center">
                                    <i class="fa fa-user mt-2" style="font-size: 25px"></i>
                                </div>
                                <div class="chat-list_content_description">
                                    <div class="chat-list_content_description_header">
                                        <span><?= $message->from0->username ?></span>
                                        <div class="chat-list_content_description_header_time ml-1">
                                            <small style="font-size: 12px"><?= $message->message->created ?></small>
                                        </div>
                                        <div class="chat-list_content_description_body">
                                            <div class="chat-list_content_description_body_message">
                                                <span><?= $message->message->message ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php else: ?>
                        <a href="<?= Url::to(['message/select', 'id' => $message->message->chat_id]) ?>"
                           class="select_user">
                            <div class="chat-list_content">
                                <div class="avatar text-center">
                                    <i class="fa fa-user mt-2" style="font-size: 25px"></i>
                                </div>
                                <div class="chat-list_content_description">
                                    <div class="chat-list_content_description_header">
                                        <span><?= $message->to0->username ?></span>
                                        <div class="chat-list_content_description_header_time ml-1">
                                            <small style="font-size: 12px"><?= $message->message->created ?></small>
                                        </div>
                                        <div class="chat-list_content_description_body">
                                            <div class="chat-list_content_description_body_message">
                                                <span><?= $message->message->message ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endif; endforeach; endif; ?>
                </div>
            </div>
        </div>
            <?php Pjax::begin(['id' => 'chat-message']) ?>
            <?= $this->render('_messages', compact('model', 'private_chat')) ?>
            <?php Pjax::end() ?>

    </div>
</div>
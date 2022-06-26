<?php
use yii\helpers\Url;
?>

<div class="chat-column-left">
    <div class="chat-list">
        <form class="form-inline active-pink-3 my-2 active-pink-4">
            <input class="form-control form-control-sm ml-3 w-75 border-0" type="text" placeholder="Search"
                   aria-label="Search">
            <i class="fas fa-search" aria-hidden="true"></i>
        </form>
        <div class="chat-list_rooms">
            <?php

            if ($messages) : foreach ($messages as $message) : if ($message->to == Yii::$app->user->id) : ?>
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

<?php

/**
 * @var $this \yii\web\View
 * @var $messages \common\models\Message[]
 * @var $model \common\models\Message;
 * @var $private_chat \common\models\Chat[]
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
        <?= $this->render('_user', compact('messages'));  ?>
        <?php Pjax::begin(['id' => 'chat-message']); ?>
            <?= $this->render('_messages', compact('model', 'private_chat')); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
<?php

$js = <<<JS

function click(){
    alert('fjhsbdj');
}

JS;

$this->registerJs($js);
?>
<?php
/**
 * @var $this \yii\web\View
 * @var $private_messsage \common\models\Message[]
 * @var $private_chat \common\models\Chat
 * @var $model \common\models\Message
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<?php if ($private_chat) : ?>
    <div class="chat-column-right">
        <div class="chat-info">
            <?php if ($private_chat->from != Yii::$app->user->id) : ?>
                <div class="chat-info_user">
                    <div class="chat-info_user_fullname"><?= $private_chat->from0->username ?></div>
                    <div class="chat-info_user_last_visit"><?= $private_chat->from0->seen->formatTime ?></div>
                </div>
            <?php else : ?>
                <div class="chat-info_user">
                    <div class="chat-info_user_fullname"><?= $private_chat->to0->username ?></div>
                    <div class="chat-info_user_last_visit"><?= Yii::t('app', 'So\'ngi faollik ') . $private_chat->to0->seen->formatTime ?></div>
                </div>
            <?php endif; ?>
        </div>
        <div class="chat-message">
            <?= $private_chat->renderMessage; ?>
        </div>
        <div class="chat-form">
            <?php $form = ActiveForm::begin([
                'action' => Url::to(['/message/send']),
                'options' => [
                    'class' => 'form-inline',
                    'id' => 'chat-form',
                ],
                'fieldConfig' => [
                    'template' => "{input}",
                    'options' => ['tag' => false],
                ],
            ]); ?>
            <?= $form->field($model, 'from')->hiddenInput(['value' => $private_chat->from]) ?>
            <div class="input-group w-100">
                    <span class="input-group-prepend">
                        <label class="btn btn-secondary" id="file" data-toggle="tooltip" data-placement="top"
                               title="Rasm uchun">
                            <i class="fa fa-file-alt"></i>
                            <?= $form->field($model, 'image')->fileInput(['class' => 'file', 'id' => 'message-file'])->label(false); ?>
                        </label>
                    </span>
                <?= $form->field($model, 'message')->textInput(['placeholder' => Yii::t('app', 'Xabar yozish...'), 'id' => 'chat-text', 'autocomplete' => 'off'])->label(false); ?>
                <span class="input-group-append">
                    <button class="btn btn-primary" id="btn" onclick="click()">
                        <i class="fa fa-paper-plane"></i>
                    </button>
                </span>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    </div>
<?php else: ?>
    <div style="transform: translateY(120px)" class="text-center note">
        <h3 class="text-info"><?= Yii::t('app', 'Xabarni tanlang') ?></h3>
        <span class="spinner-grow bg-info d-none"></span>
    </div>
<?php endif; ?>




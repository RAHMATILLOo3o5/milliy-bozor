<?php

use mihaildev\ckeditor\CKEditor;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Sayt Shartlari';

?>


<div class="row">
    <div class="col-10 offset-1">
        <div class="card p-2">
            <?php $form = ActiveForm::begin();  ?>

            <?= $form->field($model, 'content_uz')->widget(CKEditor::class, [
                'editorOptions' => [
                    'preset' => 'full'
                ]
            ]) ?>

            <?= $form->field($model, 'content_ru')->widget(CKEditor::class, [
                'editorOptions' => [
                    'preset' => 'full'
                ]
            ]) ?>

            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>

            <?php ActiveForm::end();  ?>
        </div>
    </div>
</div>
<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%footer}}`.
 */
class m220628_050028_create_footer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%footer}}', [
            'id' => $this->primaryKey(),
            'text_uz'=>$this->text(),
            'text_ru'=>$this->text(),
            'twitter'=>$this->string(200),
            'facebook'=>$this->string(200),
            'instagram'=>$this->string(200),
            'youtube'=>$this->string(200),
            'telegram'=>$this->string(200),
            'pinterest'=>$this->string(200),
            'status'=>$this->boolean()->defaultValue(false),
            'created_at'=>$this->integer(),
            'updated_at'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%footer}}');
    }
}

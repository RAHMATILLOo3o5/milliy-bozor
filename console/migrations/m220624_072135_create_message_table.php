<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 */
class m220624_072135_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'chat_id' => $this->integer(),
            'from' => $this->integer(),
            'message' => $this->text(),
            'image' => $this->string(),
            'status' => $this->boolean()->defaultValue(false),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey('fk_message_chat', '{{%message}}', 'chat_id', '{{%chat}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_message_from', '{{%message}}', 'from', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%message}}');
    }
}

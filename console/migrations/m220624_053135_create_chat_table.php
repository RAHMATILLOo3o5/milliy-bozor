<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chat}}`.
 */
class m220624_053135_create_chat_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%chat}}', [
            'id' => $this->primaryKey(),
            'from' => $this->integer(),
            'to' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey('fk_chat_from', 'chat', 'from', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_chat_to', 'chat', 'to', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_chat_from', 'chat');
        $this->dropForeignKey('fk_chat_to', 'chat');
        $this->dropTable('{{%chat}}');
    }
}

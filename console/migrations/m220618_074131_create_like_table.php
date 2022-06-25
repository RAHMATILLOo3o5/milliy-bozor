<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%like}}`.
 */
class m220618_074131_create_like_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%like}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'product_id' => $this->integer(),
            'created_at' => $this->integer()
        ]);
        $this->addForeignKey('{{%fk-like-to-user}}', '{{%like}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%fk-like-to-product}}', '{{%like}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('{{%fk-like-to-user}}', '{{%like}}');
        $this->dropForeignKey('{{%fk-like-to-product}}', '{{%like}}');
        $this->dropTable('{{%like}}');
    }
}

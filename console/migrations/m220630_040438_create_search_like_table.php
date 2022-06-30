<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%search_like}}`.
 */
class m220630_040438_create_search_like_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%search_like}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'query' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('fk_search_like_user', '{{%search_like}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_search_like_user', '{{%search_like}}');
        $this->dropTable('{{%search_like}}');
    }
}

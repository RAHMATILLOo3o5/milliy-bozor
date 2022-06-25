<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seen}}`.
 */
class m220527_165210_create_seen_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%seen}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'last_seen'=>$this->integer()->notNull()
        ]);
        $this->addForeignKey('fk-seen-to-user', 'seen', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-seen-to-user', 'seen');
        $this->dropTable('{{%seen}}');
    }
}

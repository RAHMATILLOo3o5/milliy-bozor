<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%admin}}`.
 */
class m220517_105353_create_admin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%admin}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'created_at' => $this->integer(),
        ]);
        $this->addForeignKey('fk-admin-user', 'admin', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-admin-user', 'admin');
        $this->dropTable('{{%admin}}');
    }
}

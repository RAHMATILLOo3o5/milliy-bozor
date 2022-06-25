<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%service_coment}}`.
 */
class m220621_154840_create_service_coment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%service_coment}}', [
            'id' => $this->primaryKey(),
            'service_id' => $this->integer(),
            'content' => $this->text(),
            'user_id' => $this->integer(),
            'created_at' => $this->integer()
        ]);
        $this->addForeignKey('fk-service_comonet-to-service', 'service_coment', 'service_id', 'service', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-service_comonet-to-user', 'service_coment', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-service_comonet-to-service', 'service_coment');
        $this->dropForeignKey('fk-service_comonet-to-user', 'service_coment');
        $this->dropTable('{{%service_coment}}');
    }
}

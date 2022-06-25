<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%offer_coment}}`.
 */
class m220621_154327_create_offer_coment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%offer_coment}}', [
            'id' => $this->primaryKey(),
            'offer_id' => $this->integer(),
            'content' => $this->text(),
            'user_id' => $this->integer(),
            'created_at' => $this->integer()
        ]);
        $this->addForeignKey('fk-offer_comonet-to-offer', 'offer_coment', 'offer_id', 'offer', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-offer_comonet-to-user', 'offer_coment', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-offer_comonet-to-offer', 'offer_coment');
        $this->dropForeignKey('fk-offer_comonet-to-user', 'offer_coment');
        $this->dropTable('{{%offer_coment}}');
    }
}

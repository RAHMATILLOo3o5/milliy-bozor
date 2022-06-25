<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact}}`.
 */
class m220621_170814_create_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(200)->notNull(),
            'job' => $this->string(220)->notNull(),
            'body' => $this->text()->notNull(),
            'status' => $this->boolean()->defaultValue(false),
            'read' => $this->boolean()->defaultValue(false),
            'user_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        $this->addForeignKey('fk-contact-to-user', 'contact', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-contact-to-user', 'contact');
        $this->dropTable('{{%contact}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%monthticket}}`.
 */
class m220621_164016_create_monthticket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%monthticket}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'option_uz' => $this->text()->notNull(),
            'option_ru' => $this->text()->notNull(),
            'limit_uz' => $this->text()->notNull(),
            'limit_ru' => $this->text()->notNull(),
            'sale' => $this->integer(),
            'price' => $this->integer()->notNull(),
            'order' => $this->integer()->notNull(),
            'status' => $this->boolean()->defaultValue(false),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%monthticket}}');
    }
}

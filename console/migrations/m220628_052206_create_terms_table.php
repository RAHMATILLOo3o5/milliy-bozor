<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%terms}}`.
 */
class m220628_052206_create_terms_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%terms}}', [
            'id' => $this->primaryKey(),
            'content_uz' => $this->text()->notNull(),
            'content_ru' => $this->text()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%terms}}');
    }
}

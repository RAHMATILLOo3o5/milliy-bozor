<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m220618_073013_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string()->notNull(),
            'name_ru' => $this->string()->notNull(),
            'section_id' => $this->integer(),
            'status' => $this->boolean()->defaultValue(false),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        $this->addForeignKey('fk-category-to-section', '{{%category}}', 'section_id', 'section', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-category-to-section', '{{%category}}');
        $this->dropTable('{{%category}}');
    }
}

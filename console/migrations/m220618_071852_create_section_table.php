<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%section}}`.
 */
class m220618_071852_create_section_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%section}}', [
            'id' => $this->primaryKey(),
            'name_uz' => $this->string(240)->notNull(),
            'name_ru' => $this->string(240)->notNull(),
            'img' => $this->string(255),
            'status' => $this->boolean()->defaultValue(false),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%section}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%policy}}`.
 */
class m220628_052258_create_policy_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%policy}}', [
            'id' => $this->primaryKey(),
            'content_uz' => $this->text(),
            'content_ru' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%policy}}');
    }
}

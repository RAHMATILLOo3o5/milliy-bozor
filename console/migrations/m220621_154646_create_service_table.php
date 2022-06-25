<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%service}}`.
 */
class m220621_154646_create_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%service}}', [
            'id' => $this->primaryKey(),
            'title_uz' => $this->string(255),
            'title_ru' => $this->string(255),
            'content_uz' => $this->text(),
            'content_ru' => $this->text(),
            'img' => $this->string(255),
            'phone' => $this->string(255),
            'province_id' => $this->integer(),
            'tuman_id' => $this->integer(),
            'status' => $this->boolean()->defaultValue(false),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey('fk_service_province', '{{%service}}', 'province_id', '{{%province}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_service_tuman', '{{%service}}', 'tuman_id', '{{%tumanlar}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_service_province', '{{%service}}');
        $this->dropForeignKey('fk_service_tuman', '{{%service}}');
        $this->dropTable('{{%service}}');
    }
}

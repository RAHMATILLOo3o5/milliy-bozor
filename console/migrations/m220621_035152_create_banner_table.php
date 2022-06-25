<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%banner}}`.
 */
class m220621_035152_create_banner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%banner}}', [
            'id' => $this->primaryKey(),
            'title_uz' => $this->string()->null(),
            'title_ru' => $this->string()->null(),
            'description_uz' => $this->text()->null(),
            'description_ru' => $this->text()->null(),
            'price' => $this->string()->null(),
            'currency' => $this->string()->null(),
            'image' => $this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%banner}}');
    }
}

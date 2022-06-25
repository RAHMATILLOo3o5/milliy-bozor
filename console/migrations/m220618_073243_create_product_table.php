<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m220618_073243_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(200),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'img' => $this->string(255),
            'price' => $this->integer(),
            'user_id' => $this->integer(),
            'section_id' => $this->integer(),
            'category_id' => $this->integer(),
            'is_top' => $this->boolean()->defaultValue(false),
            'status' => $this->boolean()->defaultValue(false),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-product-to-user',
            'product',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-product-to-section',
            'product',
            'section_id',
            'section',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-product-to-category',
            'product',
            'category_id',
            'category',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-product-to-user', 'product');
        $this->dropForeignKey('fk-product-to-section', 'product');
        $this->dropForeignKey('fk-product-to-category', 'product');
        $this->dropTable('{{%product}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%view}}`.
 */
class m220618_074142_create_view_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%view}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'product_id' => $this->integer(),
            'view_count'=>$this->integer(),
            'created_at' => $this->integer(),
        ]);
        $this->addForeignKey('fk-view-user_id', '{{%view}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-view-product_id', '{{%view}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-view-user_id', '{{%view}}');
        $this->dropForeignKey('fk-view-product_id', '{{%view}}');
        $this->dropTable('{{%view}}');
    }
}

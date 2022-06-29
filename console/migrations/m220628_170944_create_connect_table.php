<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%connect}}`.
 */
class m220628_170944_create_connect_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%connect}}', [
            'id' => $this->primaryKey(),
            'phone'=>$this->string(255),
            'status'=>$this->boolean()->defaultValue(false)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%connect}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%province}}`.
 */
class m220515_022212_create_province_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%province}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(200)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%province}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%meta}}`.
 */
class m220630_101227_create_meta_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%meta}}', [
            'id' => $this->primaryKey(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%meta}}');
    }
}

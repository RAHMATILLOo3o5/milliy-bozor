<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%top_time}}`.
 */
class m220622_041947_create_top_time_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%top_time}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'day_id' => $this->integer(),
            'month_id' => $this->integer(),
            'register_time' => $this->integer(),
            'exp_time' => $this->integer(),
            'status' => $this->boolean()->defaultValue(true)
        ]);
        $this->addForeignKey('fk-month', 'top_time', 'month_id', 'monthticket', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-dayticket', 'top_time', 'day_id', 'dayticket', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-users', 'top_time', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-month', 'top_time');
        $this->dropForeignKey('fk-dayticket', 'top_time');
        $this->dropForeignKey('fk-users', 'top_time');
        $this->dropTable('{{%top_time}}');
    }
}

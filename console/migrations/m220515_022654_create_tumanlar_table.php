<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tumanlar}}`.
 */
class m220515_022654_create_tumanlar_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tumanlar}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull(),
            'province_id'=>$this->integer(),
        ]);
        $this->addForeignKey('fk-tuman-to-province', '{{%tumanlar}}', 'province_id', '{{%province}}', 'id', 'CASCADE','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-tuman-to-province', '{{%tumanlar}}');
        $this->dropTable('{{%tumanlar}}');
    }
}

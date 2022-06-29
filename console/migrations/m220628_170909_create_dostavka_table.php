<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dostavka}}`.
 */
class m220628_170909_create_dostavka_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dostavka}}', [
            'id' => $this->primaryKey(),
            'title_uz'=> $this->string(255)->notNull(),
            'title_ru'=>$this->string(255)->notNull(),
            'description_uz'=>$this->text()->notNull(),
            'description_ru'=>$this->text()->notNull(),
            'status'=>$this->boolean()->defaultValue(false)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dostavka}}');
    }
}

<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'province_id' => $this->integer(),
            'tuman_id' => $this->integer(),
            'phone' => $this->string(200),
            'is_top' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addForeignKey('fk-user-to-province', '{{%user}}', 'province_id', '{{%province}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-user-to-tumanlar', '{{%user}}', 'tuman_id', '{{%tumanlar}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk-user-to-province', '{{%user}}');
        $this->dropForeignKey('fk-user-to-tumanlar', '{{%user}}');
        $this->dropTable('{{%user}}');
    }
}

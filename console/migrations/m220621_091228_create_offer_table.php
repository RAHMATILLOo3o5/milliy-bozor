<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%offer}}`.
 */
class m220621_091228_create_offer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%offer}}', [
            'id' => $this->primaryKey(),
            'title_uz'=>$this->string(250),
            'title_ru'=>$this->string(250),
            'content_uz'=>$this->text(),
            'content_ru'=>$this->text(),
            'img'=>$this->string(250),
            'price'=>$this->integer(),
            'sale'=>$this->integer(),
            'owner' => $this->string(240)->notNull(),
            'phone' => $this->string(120)->notNull(),
            'province_id' => $this->integer()->notNull(),
            'tuman_id' => $this->integer()->notNull(),
            'email' => $this->string(240)->notNull(),
            'status'=>$this->boolean()->defaultValue(false),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey('fk_offercontact_province', 'offer', 'province_id', 'province', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_offercontact_tuman', 'offer', 'tuman_id', 'tumanlar', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_offercontact_province', 'offer');
        $this->dropForeignKey('fk_offercontact_tuman', 'offer');
        $this->dropTable('{{%offer}}');
    }
}

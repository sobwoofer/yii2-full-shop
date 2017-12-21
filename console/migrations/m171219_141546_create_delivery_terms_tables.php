<?php

use yii\db\Migration;

/**
 * Class m171219_141546_create_delivery_terms_tables
 */
class m171219_141546_create_delivery_terms_tables extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%shop_delivery_terms}}', [
            'id' => $this->primaryKey(),
            'external_id' => $this->integer()->notNull(),
            'slug' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_delivery_terms-external_id}}', '{{%shop_delivery_terms}}', 'external_id');

        $this->createTable('{{%shop_delivery_terms_lang}}', [
            'id' => $this->primaryKey(),
            'delivery_term_id' => $this->integer()->notNull(),
            'language' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_delivery_terms_lang-delivery_term_id}}', '{{%shop_delivery_terms_lang}}', 'delivery_term_id');

        $this->addForeignKey(
            '{{%fk-shop_delivery_terms_lang-delivery_term_id}}',
            '{{%shop_delivery_terms_lang}}',
            'delivery_term_id',
            '{{shop_delivery_terms}}',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropTable('{{%shop_delivery_terms}}');
        $this->dropTable('{{%shop_delivery_terms_lang}}');
    }

}

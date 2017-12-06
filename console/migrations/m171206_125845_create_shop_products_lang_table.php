<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_products_lang`.
 */
class m171206_125845_create_shop_products_lang_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%shop_products_lang}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'title' => $this->string(),
            'description' => $this->text(),
            'meta_json' => 'JSON NOT NULL',
            'language' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_products_lang-product_id}}', '{{%shop_products_lang}}', 'product_id');
        $this->createIndex('{{%idx-shop_products_lang-language}}', '{{%shop_products_lang}}', 'language');
        $this->addForeignKey(
            '{{%fk-shop_products_lang-product_id}}',
            '{{%shop_products_lang}}',
            'product_id',
            '{{%shop_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%shop_products_lang}}');
    }
}

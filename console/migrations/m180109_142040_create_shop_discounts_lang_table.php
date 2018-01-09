<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_discounts_lang`.
 */
class m180109_142040_create_shop_discounts_lang_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%shop_discounts_lang}}', [
            'id' => $this->primaryKey(),
            'discount_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'language' => $this->string()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-shop_discounts_lang-discount_id',
            '{{%shop_discounts_lang}}',
            'discount_id',
            '{{%shop_discounts}}',
            'id'
        );

        $this->createIndex(
            'idx-shop_discounts_lang-language',
            '{{%shop_discounts_lang}}',
            'language'
        );

        $this->createIndex(
            'idx-shop_discounts_lang-discount_id',
            '{{%shop_discounts_lang}}',
            'discount_id'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%shop_discounts_lang}}');
    }
}

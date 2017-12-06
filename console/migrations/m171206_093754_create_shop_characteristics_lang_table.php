<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_charecteristics_lang`.
 */
class m171206_093754_create_shop_characteristics_lang_table extends Migration
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

        $this->createTable('{{%shop_characteristics_lang}}', [
            'id' => $this->primaryKey(),
            'characteristic_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'variants_json' => 'JSON NOT NULL',
            'language' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_characteristics_lang-category_id}}', '{{%shop_characteristics_lang}}', 'characteristic_id');
        $this->createIndex('{{%idx-shop_characteristics_lang-language}}', '{{%shop_characteristics_lang}}', 'language');
        $this->addForeignKey(
            '{{%fk-shop_characteristics_lang-characteristic_id}}',
            '{{%shop_characteristics_lang}}',
            'characteristic_id',
            '{{%shop_characteristics}}',
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
        $this->dropTable('{{%shop_characteristics_lang}}');
    }
}

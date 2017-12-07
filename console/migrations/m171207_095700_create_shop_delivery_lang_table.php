<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_delivery_lang`.
 */
class m171207_095700_create_shop_delivery_lang_table extends Migration
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

        $this->createTable('{{%shop_delivery_methods_lang}}', [
            'id' => $this->primaryKey(),
            'delivery_method_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'language' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_delivery_methods_lang-delivery_method_id}}', '{{%shop_delivery_methods_lang}}', 'delivery_method_id');
        $this->createIndex('{{%idx-shop_delivery_methods_lang-language}}', '{{%shop_delivery_methods_lang}}', 'language');
        $this->addForeignKey(
            '{{%fk-shop_delivery_methods_lang-delivery_method_id}}',
            '{{%shop_delivery_methods_lang}}',
            'delivery_method_id',
            '{{%shop_delivery_methods}}',
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
        $this->dropTable('{{%shop_delivery_lang}}');
    }
}

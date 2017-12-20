<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_buy_with`.
 */
class m171220_084250_create_product_buy_with_table extends Migration
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

        $this->createTable('{{%shop_buy_with_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'related_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-shop_buy_with_assignments}}', '{{%shop_buy_with_assignments}}', ['product_id', 'related_id']);
        $this->createIndex('{{%idx-shop_buy_with_assignments-product_id}}', '{{%shop_buy_with_assignments}}', 'product_id');
        $this->createIndex('{{%idx-shop_buy_with_assignments-related_id}}', '{{%shop_buy_with_assignments}}', 'related_id');

        $this->addForeignKey(
            '{{%fk-shop_buy_with_assignments-product_id}}',
            '{{%shop_buy_with_assignments}}',
            'product_id',
            '{{%shop_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->addForeignKey(
            '{{%fk-shop_buy_with_assignments-related_id}}',
            '{{%shop_buy_with_assignments}}',
            'related_id',
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
        $this->dropTable('{{%shop_product_buy_with}}');
    }
}

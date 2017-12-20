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
        $this->createTable('{{%shop_product_buy_with}}', [
            'product_id' => $this->integer()->notNull(),
            'relative_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-shop_product_buy_with}}', '{{%shop_product_buy_with}}', ['product_id', 'relative_id']);

        $this->createIndex('{{%idx-shop_product_buy_with-ids}}', '{{%shop_product_buy_with}}', ['product_id', 'relative_id']);

        $this->addForeignKey('{{%fk-shop_product_buy_with-product_id}}',
            '{{%shop_product_buy_with}}',
            'product_id',
            '{{%shop_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->addForeignKey('{{%fk-shop_product_buy_with-relative_id}}',
            '{{%shop_product_buy_with}}',
            'relative_id',
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

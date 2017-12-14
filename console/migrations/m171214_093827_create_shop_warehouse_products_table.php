<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_warehouse_products`.
 */
class m171214_093827_create_shop_warehouse_products_table extends Migration
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

        $this->createTable('{{%shop_warehouses_products}}', [
            'id' => $this->primaryKey(),
            'warehouse_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'external_status' => $this->integer()->notNull()->defaultValue(1), //DEFINED IN PRODUCT ENTITY
            'extra_status_id' => $this->integer()->notNull(),
            'price' => $this->float()->notNull(),
            'quantity' => $this->integer(),
            'special' => $this->float(),
            'special_status' => $this->smallInteger(1)->defaultValue(1),
            'special_start' => $this->integer(),
            'special_end' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_warehouses_products-external_status}}', '{{%shop_warehouses_products}}', 'external_status');
        $this->createIndex('{{%idx-shop_warehouses_products-warehouse_id}}', '{{%shop_warehouses_products}}', 'warehouse_id');
        $this->createIndex('{{%idx-shop_warehouses_products-product_id}}', '{{%shop_warehouses_products}}', 'product_id');
        $this->createIndex('{{%idx-shop_warehouses_products-extra_status_id}}', '{{%shop_warehouses_products}}', 'extra_status_id');

        $this->addForeignKey(
            '{{%fk-shop_warehouses_products-warehouse_id}}',
            '{{%shop_warehouses_products}}',
            'warehouse_id',
            '{{shop_warehouses}}',
            'id'
        );

        $this->addForeignKey(
            '{{%fk-shop_warehouses_products-product_id}}',
            '{{%shop_warehouses_products}}',
            'product_id',
            '{{shop_products}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
                '{{%fk-shop_warehouses_products-extra_status_id}}',
                '{{%shop_warehouses_products}}',
                'extra_status_id',
                '{{shop_product_extra_statuses}}',
                'id'
            );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%shop_warehouse_products}}');
    }
}

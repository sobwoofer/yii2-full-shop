<?php

use yii\db\Migration;

/**
 * Handles adding delivery_term_id to table `warejouse_products`.
 */
class m171219_142541_add_delivery_term_id_column_to_warejouse_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%shop_warehouses_products}}', 'delivery_term_id', $this->integer());

        $this->createIndex('{{%idx-shop_warehouses_products-delivery_term_id}}', '{{%shop_warehouses_products}}', 'delivery_term_id');

        $this->addForeignKey(
            '{{%fk-shop_warehouses_products-delivery_term_id}}',
            '{{%shop_warehouses_products}}',
            'delivery_term_id',
            '{{shop_product_delivery_terms}}',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%shop_warehouses_products}}', 'delivery_term_id');
    }
}

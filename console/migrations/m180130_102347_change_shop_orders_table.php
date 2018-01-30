<?php

use yii\db\Migration;

/**
 * Class m180130_102347_change_shop_orders_table
 */
class m180130_102347_change_shop_orders_table extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
//        $this->dropForeignKey('{{%fk-shop_orders-user_id}}', '{{%shop_orders}}');
        $this->dropForeignKey('{{%fk-shop_orders-delivery_method_id}}', '{{%shop_orders}}');
        $this->dropIndex('{{%idx-shop_orders-user_id}}', '{{%shop_orders}}');
        $this->dropColumn('{{%shop_orders}}', 'user_id');
        $this->addColumn('{{%shop_orders}}', 'user_id', $this->integer());
        $this->renameColumn('{{%shop_orders}}', 'payment_method','payment_method_name');
        $this->addForeignKey(
            '{{%fk-shop_orders-delivery_method_id}}',
            '{{%shop_orders}}',
            'delivery_method_id',
            '{{%shop_delivery_methods}}',
            'id'
        );

        $this->createIndex(
            '{{%idx-shop_orders-user_id}}',
            '{{%shop_orders}}',
            'user_id'
        );

        $this->addForeignKey(
            '{{%fk-shop_orders-user_id}}',
            '{{%shop_orders}}',
            'user_id',
            '{{%users}}',
            'id'
        );

        $this->addColumn('{{%shop_orders}}', 'payment_method_id', $this->integer());

        $this->createIndex(
            '{{%idx-shop_orders-payment_method_id}}',
            '{{%shop_orders}}',
            'payment_method_id'
        );

        $this->addForeignKey(
            '{{%fk-shop_orders-payment_method_id}}',
            '{{%shop_orders}}',
            'payment_method_id',
            '{{%shop_payment_methods}}',
            'id'
        );

        $this->addColumn('{{%shop_orders}}', 'customer_last_name', $this->string());
        $this->dropColumn('{{%shop_orders}}', 'delivery_index');
        $this->addColumn('{{%shop_orders}}', 'customer_email', $this->string()->notNull());


    }

    public function down()
    {
        echo "m180130_102347_change_shop_orders_table cannot be reverted.\n";

        return false;
    }

}

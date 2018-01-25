<?php

use yii\db\Migration;

/**
 * Handles the creation of table `payment_to_delivery_assignments`.
 */
class m180125_084502_create_payment_to_delivery_assignments_table extends Migration
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

        $this->createTable('{{%shop_payment_to_delivery_assignments}}', [
            'payment_id' => $this->integer()->notNull(),
            'delivery_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey(
            'pk-shop_payment_to_delivery_assignments-payment_id-delivery_id',
            '{{%shop_payment_to_delivery_assignments}}',
            ['payment_id', 'delivery_id']
        );

        $this->createIndex(
            'idx-shop_payment_to_delivery_assignments-payment_id-delivery_id',
            '{{%shop_payment_to_delivery_assignments}}',
            ['payment_id', 'delivery_id']
        );

        $this->addForeignKey(
            'fk-shop_payment_to_delivery_assignments-payment_id',
            '{{%shop_payment_to_delivery_assignments}}',
            'payment_id',
            '{{%shop_payment_methods}}',
            'id'
        );

        $this->addForeignKey(
            'fk-shop_payment_to_delivery_assignments-delivery_id',
            '{{%shop_payment_to_delivery_assignments}}',
            'delivery_id',
            '{{%shop_delivery_methods}}',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%shop_payment_to_delivery_assignments}}');
    }
}

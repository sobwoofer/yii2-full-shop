<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_related_assignments`.
 */
class m170817_123542_create_shop_related_assignments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_related_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'related_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-shop_related_assignments}}', '{{%shop_related_assignments}}', ['product_id', 'related_id']);
        $this->createIndex('{{idx-shop_related_assignments-product_id}}', '{{%shop_related_assignments}}', 'product_id');
        $this->createIndex('{{idx-shop_related_assignments-related_id}}', '{{%shop_related_assignments}}', 'related_id');

        $this->addForeignKey('{{%fk-shop_related_assignments-product_id}}',
            '{{%shop_related_assignments}}',
            'product_id',
            '{{%shop_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->addForeignKey(
            '{{fk-shop_related_assignments-related_id}}',
            '{{%shop_related_assignments}}',
            'related_id',
            'shop_products',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%shop_related_assignments}}');
    }
}

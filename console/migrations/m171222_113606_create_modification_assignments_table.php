<?php

use yii\db\Migration;

/**
 * Handles the creation of table `modification_assignments`.
 */
class m171222_113606_create_modification_assignments_table extends Migration
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

        $this->createTable('{{%shop_modification_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'modification_id' => $this->integer()->notNull(),
            'min_qty' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->addPrimaryKey(
            'pk-shop_modification_assignments-product_id-modification_id',
            '{{%shop_modification_assignments}}',
            ['product_id', 'modification_id']
        );

        $this->createIndex(
            'idx-shop_modification_assignments-product_id-modification_id',
            '{{%shop_modification_assignments}}',
            ['product_id', 'modification_id']
        );

        $this->addForeignKey(
            'fk-shop_modification_assignments-product_id',
            '{{%shop_modification_assignments}}',
            'product_id',
            '{{%shop_products}}',
            'id'
        );

        $this->addForeignKey(
            'fk-shop_modification_assignments-modification_id',
            '{{%shop_modification_assignments}}',
            'modification_id',
            '{{%shop_modifications}}',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%shop_modification_assignments}}');
    }
}

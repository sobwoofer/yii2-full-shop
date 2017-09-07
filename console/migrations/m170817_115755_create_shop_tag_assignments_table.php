<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_tag_assignments`.
 */
class m170817_115755_create_shop_tag_assignments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_tag_assignments}}', [
            'product_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addPrimaryKey('{{pk-shop_tag_assignments}}','{{%shop_tag_assignments}}', ['product_id', 'tag_id']);

        $this->createIndex('{{%idx-shop_tag_assignments-product_id}}', '{{%shop_tag_assignments}}', 'product_id');
        $this->createIndex('{{%idx-shop_tag_assignments-tag_id}}', '{{%shop_tag_assignments}}', 'tag_id');

        $this->addForeignKey(
            '{{fk-shop_tag_assignments-product_id}}',
            '{{%shop_tag_assignments}}',
            'product_id',
            '{{shop_products}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
        $this->addForeignKey(
            '{{%fk-shop_tag_assignments-tag_id}}',
            '{{%shop_tag_assignments}}',
            'tag_id',
            '{{%shop_tags}}',
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
        $this->dropTable('{{%shop_tag_assignments}}');
    }
}

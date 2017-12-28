<?php

use yii\db\Migration;

/**
 * Class m171228_144828_chenge_shop_cart_items_table
 */
class m171228_144828_chenge_shop_cart_items_table extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->dropForeignKey('{{%fk-shop_cart_items-modification_id}}', '{{%shop_cart_items}}');
        $this->dropIndex('{{%idx-shop_cart_items-modification_id}}', '{{%shop_cart_items}}');
        $this->dropColumn('{{%shop_cart_items}}', 'modification_id');
        $this->addColumn('{{%shop_cart_items}}', 'modifications_json', 'JSON NOT NULL');


        $this->dropForeignKey('{{%fk-shop_cart_items-user_id}}', '{{%shop_cart_items}}');
        $this->dropIndex('{{%idx-shop_cart_items-user_id}}', '{{%shop_cart_items}}');
        $this->dropColumn('{{%shop_cart_items}}', 'user_id');
        $this->addColumn('{{%shop_cart_items}}', 'user_id', $this->integer());
        $this->createIndex('{{%idx-shop_cart_items-user_id}}', '{{%shop_cart_items}}', 'user_id');
        $this->addForeignKey(
            '{{%fk-shop_cart_items-user_id}}',
            '{{%shop_cart_items}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        return false;
    }

}

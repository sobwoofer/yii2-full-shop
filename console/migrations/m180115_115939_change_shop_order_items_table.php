<?php

use yii\db\Migration;

/**
 * Class m180115_115939_change_shop_order_items_table
 */
class m180115_115939_change_shop_order_items_table extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->dropForeignKey('{{%fk-shop_order_items-modification_id}}', '{{%shop_order_items}}');
        $this->dropIndex('{{%idx-shop_order_items-modification_id}}', '{{%shop_order_items}}');
        $this->dropColumn('{{%shop_order_items}}', 'modification_id');

        $this->dropColumn('{{%shop_order_items}}', 'modification_name');
        $this->dropColumn('{{%shop_order_items}}', 'modification_code');

        $this->addColumn('{{%shop_order_items}}', 'modifications_json', 'JSON NOT NULL');
        $this->addColumn('{{%shop_order_items}}', 'price_old', $this->float());
    }

    public function down()
    {
        echo "m180115_115939_change_shop_order_items_table cannot be reverted.\n";

        return false;
    }

}

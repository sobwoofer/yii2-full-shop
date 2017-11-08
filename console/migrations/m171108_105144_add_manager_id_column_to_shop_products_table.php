<?php

use yii\db\Migration;

/**
 * Class m171108_105144_add_columns_to_shop_products_table
 */
class m171108_105144_add_manager_id_column_to_shop_products_table extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'manager_id', $this->integer());
        $this->addForeignKey('{{%fk-shop_products-manager_id}}','{{%shop_products}}','manager_id','{{%users}}','id' );

    }

    public function down()
    {
        $this->dropForeignKey('{{%fk-shop_products-manager_id}}', '{{%shop_products}}');
        $this->dropColumn('{{%shop_products}}', 'manager_id');
    }

}

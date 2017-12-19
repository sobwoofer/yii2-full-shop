<?php

use yii\db\Migration;

/**
 * Class m171218_143819_delete_other_columns_from_products_table
 */
class m171218_143819_delete_other_columns_from_products_table extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->dropColumn('{{shop_products}}', 'price_new');
        $this->dropColumn('{{shop_products}}', 'price_old');
        $this->dropColumn('{{shop_products}}', 'quantity');

    }

    public function down()
    {
       $this->addColumn('{{shop_products}}', 'price_new', $this->integer());
       $this->addColumn('{{shop_products}}', 'price_old', $this->integer());
       $this->addColumn('{{shop_products}}', 'quantity', $this->integer());
    }

}

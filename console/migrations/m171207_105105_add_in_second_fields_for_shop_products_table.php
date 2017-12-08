<?php

use yii\db\Migration;

/**
 * Class m171207_105105_add_in_second_fields_for_shop_products_table
 */
class m171207_105105_add_in_second_fields_for_shop_products_table extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'case_code', $this->string()->notNull());
        $this->addColumn('{{%shop_products}}', 'video', $this->string());
        $this->addColumn('{{%shop_products}}', 'guide', $this->string());
        $this->addColumn('{{%shop_products}}', 'qty_in_pack', $this->string());

    }

    public function down()
    {
        $this->dropColumn('{{%shop_products}}', 'case_code');
        $this->dropColumn('{{%shop_products}}', 'video');
        $this->dropColumn('{{%shop_products}}', 'guide');
        $this->dropColumn('{{%shop_products}}', 'qty_in_pack');
    }

}

<?php

use yii\db\Migration;

/**
 * Class m180112_100429_change_tables_for_discount
 */
class m180112_100429_change_tables_for_discount extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%shop_categories}}', 'be_in_discount', $this->smallInteger()->notNull());
        $this->addColumn('{{%shop_products}}', 'be_in_discount', $this->smallInteger()->notNull()->defaultValue(1));
        $this->addColumn('{{%shop_discounts}}', 'max_cost', $this->float());
        $this->addColumn('{{%shop_discounts}}', 'min_cost', $this->float());

    }

    public function down()
    {
        echo "m180112_100429_change_tables_for_discount cannot be reverted.\n";

        return false;
    }

}

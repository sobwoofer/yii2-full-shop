<?php

use yii\db\Migration;

/**
 * Class m180109_154432_remove_name_column_from_discount_table
 */
class m180109_154432_remove_name_column_from_discount_table extends Migration
{



    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->dropColumn('{{shop_discounts}}', 'name');
    }

    public function down()
    {
        return false;
    }

}

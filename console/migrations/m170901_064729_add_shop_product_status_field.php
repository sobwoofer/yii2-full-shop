<?php

use yii\db\Migration;

class m170901_064729_add_shop_product_status_field extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'status', $this->smallInteger()->notNull());
        $this->update('{{%shop_products}}', ['status' => 1]);
    }

    public function down()
    {
        $this->dropColumn('{{%shop_products}}', 'status');
    }

}

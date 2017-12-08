<?php

use yii\db\Migration;

class m170911_121127_add_shop_product_fields extends Migration
{
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'weight', $this->integer());
        $this->addColumn('{{%shop_products}}', 'quantity', $this->integer()->notNull());
    }

    public function down()
    {
        $this->dropColumn('{{%shop_products}}', 'quantity');
        $this->dropColumn('{{%shop_products}}', 'weight');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles adding product_id to table `shop_reviews`.
 */
class m171103_145213_add_product_id_column_to_shop_reviews_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%shop_reviews}}', 'product_id', $this->integer());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{shop_reviews}}', 'product_id');
    }
}

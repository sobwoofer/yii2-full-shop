<?php

use yii\db\Migration;

/**
 * Handles the creation of table `coutry_column_to_product`.
 */
class m171211_135529_create_coutry_column_to_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'country_id', $this->integer());
        $this->addForeignKey(
            '{{%fk-shop_product-country_id}}',
            '{{%shop_products}}',
            'country_id',
            '{{%geo_countries}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%shop_product}}', 'country_id');
    }
}

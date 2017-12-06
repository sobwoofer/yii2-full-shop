<?php

use yii\db\Migration;

/**
 * Handles dropping lang from table `shop_products`.
 */
class m171206_143407_drop_lang_columns_from_shop_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('{{%shop_products}}', 'name');
        $this->dropColumn('{{%shop_products}}', 'description');
        $this->dropColumn('{{%shop_products}}', 'meta_json');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('{{%shop_products}}', 'name', $this->string()->notNull());
        $this->addColumn('{{%shop_products}}', 'description', $this->text()->notNull());
        $this->addColumn('{{%shop_products}}', 'meta_json', 'JSON NOT NULL');
    }
}

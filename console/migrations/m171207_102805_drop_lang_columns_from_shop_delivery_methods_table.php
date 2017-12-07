<?php

use yii\db\Migration;

/**
 * Handles dropping lang from table `shop_delivery_methods`.
 */
class m171207_102805_drop_lang_columns_from_shop_delivery_methods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('{{%shop_delivery_methods}}', 'name');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('{{%shop_delivery_methods}}', 'name', $this->string()->notNull());
    }
}

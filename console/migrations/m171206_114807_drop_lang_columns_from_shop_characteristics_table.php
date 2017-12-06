<?php

use yii\db\Migration;

/**
 * Handles dropping lang from table `shop_characteristics`.
 */
class m171206_114807_drop_lang_columns_from_shop_characteristics_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('{{%shop_characteristics}}', 'name');
        $this->dropColumn('{{%shop_characteristics}}', 'variants_json');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('{{%shop_characteristics}}', 'name', $this->string()->notNull());
        $this->addColumn('{{%shop_characteristics}}', 'variants_json', 'JSON NOT NULL');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles dropping leng from table `shop_brands`.
 */
class m171205_134925_drop_leng_columns_from_shop_brands_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('{{%shop_brands}}', 'name');
        $this->dropColumn('{{%shop_brands}}', 'meta_json');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('{{%shop_brands}}', 'name', $this->string()->notNull());
        $this->addColumn('{{%shop_brands}}', 'meta_json', 'JSON NOT NULL');
    }
}

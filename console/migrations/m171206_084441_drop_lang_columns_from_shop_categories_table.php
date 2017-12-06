<?php

use yii\db\Migration;

/**
 * Handles dropping lang from table `shop_categories`.
 */
class m171206_084441_drop_lang_columns_from_shop_categories_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('{{%shop_categories}}', 'name');
        $this->dropColumn('{{%shop_categories}}', 'title');
        $this->dropColumn('{{%shop_categories}}', 'description');
        $this->dropColumn('{{%shop_categories}}', 'meta_json');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('{{%shop_categories}}', 'name', $this->string()->notNull());
        $this->addColumn('{{%shop_categories}}', 'title', $this->string());
        $this->addColumn('{{%shop_categories}}', 'description', $this->text());
        $this->addColumn('{{%shop_categories}}', 'meta_json', 'JSON NOT NULL');
    }
}

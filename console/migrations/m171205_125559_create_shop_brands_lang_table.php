<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_brands_lang`.
 */
class m171205_125559_create_shop_brands_lang_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName == 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDb';
        }
        $this->createTable('{{%shop_brands_lang}}', [
            'id' => $this->primaryKey(),
            'brand_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'meta_json' => 'JSON NOT NULL',
            'language' => $this->string()->notNull()
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%shop_brands_lang}}');
    }
}

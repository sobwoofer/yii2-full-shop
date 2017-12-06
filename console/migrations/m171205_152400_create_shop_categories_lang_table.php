<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_categories_lang`.
 */
class m171205_152400_create_shop_categories_lang_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%shop_categories_lang}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'title' => $this->string(),
            'description' => $this->text(),
            'meta_json' => 'JSON NOT NULL',
            'language' => $this->string()->notNull()
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_categories_lang-category_id}}', '{{%shop_categories_lang}}', 'category_id');
        $this->createIndex('{{%idx-shop_categories_lang-language}}', '{{%shop_categories_lang}}', 'language');
        $this->addForeignKey(
            '{{%fk-shop_categories_lang-category_id}}',
            '{{%shop_categories_lang}}',
            'category_id',
            '{{%shop_categories}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%shop_categories_lang}}');
    }
}

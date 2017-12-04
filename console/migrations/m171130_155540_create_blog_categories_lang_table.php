<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog_categories_lang`.
 */
class m171130_155540_create_blog_categories_lang_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName == 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%blog_categories_lang}}', [
            'id' => $this->primaryKey(),
            'language' => $this->string(6)->notNull(),
            'category_id' => $this->integer(),
            'name' => $this->string(),
            'title' => $this->string(),
            'description' => $this->text(),
            'meta_json' => 'JSON NOT NULL',

        ], $tableOptions);

        $this->createIndex('{{%idx-blog_categories_lang-category_id}}', '{{%blog_categories_lang}}', 'category_id');
        $this->createIndex('{{%idx-blog_categories_lang-language}}', '{{%blog_categories_lang}}', 'language');
        $this->addForeignKey(
            '{{%fk-blog_categories_lang-category_id}}',
            '{{%blog_categories_lang}}',
            'category_id',
            '{{%blog_categories}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%blog_categories_lang}}');
    }
}

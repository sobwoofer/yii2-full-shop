<?php

use yii\db\Migration;

/**
 * Class m171204_140800_remove_lang_columns_from_blog_categories_table
 */
class m171204_140800_remove_lang_columns_from_blog_categories_table extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->dropColumn('{{%blog_categories}}', 'name');
        $this->dropColumn('{{%blog_categories}}', 'title');
        $this->dropColumn('{{%blog_categories}}', 'description');
        $this->dropColumn('{{%blog_categories}}', 'meta_json');
    }

    public function down()
    {
        $this->addColumn('{{%blog_categories}}', 'name', $this->string()->notNull());
        $this->addColumn('{{%blog_categories}}', 'title', $this->string());
        $this->addColumn('{{%blog_categories}}', 'description', $this->text());
        $this->addColumn('{{%blog_categories}}', 'meta_json', 'JSON NOT NULL');
    }

}

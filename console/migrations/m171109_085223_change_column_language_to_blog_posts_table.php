<?php

use yii\db\Migration;

/**
 * Class m171109_085223_change_column_language_to_blog_posts_table
 */
class m171109_085223_change_column_language_to_blog_posts_table extends Migration
{

    public function up()
    {
        $this->dropColumn('{{%blog_posts_lang}}', 'language');
        $this->addColumn('{{%blog_posts_lang}}', 'lang_id', $this->integer());

        $this->createIndex('{{%idx-blog_posts_lang-lang_id}}', '{{%blog_posts_lang}}', 'lang_id');
        $this->addForeignKey(
            '{{%fk-blog_posts_lang-lang_id}}',
            '{{%blog_posts_lang}}',
            'lang_id',
            '{{%lang}}',
            'id');

    }

    public function down()
    {
        $this->dropColumn('{{%blog_posts_lang}}', 'lang_id');
        $this->addColumn('{{%blog_posts_lang}}', 'language', $this->string());

    }

}

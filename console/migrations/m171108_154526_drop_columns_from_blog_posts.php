<?php

use yii\db\Migration;

/**
 * Class m171108_154526_drop_columns_from_blog_posts
 */
class m171108_154526_drop_columns_from_blog_posts extends Migration
{

    public function up()
    {
        $this->dropColumn('{{%blog_posts}}', 'title');
        $this->dropColumn('{{%blog_posts}}', 'description');
        $this->dropColumn('{{%blog_posts}}', 'content');
        $this->dropColumn('{{%blog_posts}}', 'meta_json');

    }

    public function down()
    {
        $this->addColumn('{{%blog_posts}}', 'title', $this->string()->notNull());
        $this->addColumn('{{%blog_posts}}', 'description', $this->text());
        $this->addColumn('{{%blog_posts}}', 'content', 'MEDIUMTEXT');
        $this->addColumn('{{%blog_posts}}', 'meta_json', 'JSON NOT NULL');
    }

}

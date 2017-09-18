<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog_posts`.
 */
class m170918_073918_create_blog_posts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf_8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%blog_posts}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'content' => 'MEDIUMTEXT',
            'photo' => $this->string(),
            'status' => $this->integer()->notNull(),
            'meta_json' => 'JSON NOT NULL',
        ], $tableOptions);

        $this->createIndex('{{%idx-blog_posts-category_id}}', '{{%blog_posts}}', 'category_id');
        $this->addForeignKey('{{%fk-blog_posts-category_id}}', '{{%blog_posts}}', 'category_id', '{{%blog_categories}}', 'id');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%blog_posts}}');
    }
}

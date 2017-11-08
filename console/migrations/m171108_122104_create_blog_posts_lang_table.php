<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog_posts_language`.
 */
class m171108_122104_create_blog_posts_lang_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('blog_posts_lang', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'language' => $this->string(6)->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text(),
            'content' => 'MEDIUMTEXT',
            'meta_json' => 'JSON NOT NULL',
        ], $tableOptions);

        $this->createIndex('{{%idx-blog_posts_lang-post_id}}', '{{%blog_posts_lang}}', 'post_id');
        $this->createIndex('{{%idx-blog_posts_lang-language}}', '{{%blog_posts_lang}}', 'language');
        $this->addForeignKey(
            '{{%fk-blog_posts_lang-post_id}}',
            '{{%blog_posts_lang}}',
            'post_id',
            '{{%blog_posts}}',
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
        $this->dropTable('blog_posts_lang');
    }
}

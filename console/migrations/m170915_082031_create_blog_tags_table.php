<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog_tags`.
 */
class m170915_082031_create_blog_tags_table extends Migration
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

        $this->createTable('{{%blog_tags}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull()
        ], $tableOptions);

        $this->createIndex('{{idx_blog_tags-slug}}','{{%blog_tags}}','slug', true);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%blog_tags}}');
    }
}

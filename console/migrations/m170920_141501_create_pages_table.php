<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pages`.
 */
class m170920_141501_create_pages_table extends Migration
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
        $this->createTable('{{%pages}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'content' => 'MEDIUMTEXT',
            'meta_json' => 'JSON NOT NULL',
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-pages-slug}}', '{{%pages}}', 'slug', true);

        $this->insert('{{%pages}}', [
            'id' => 1,
            'title' => '',
            'slug' => 'root',
            'content' => null,
            'meta_json' => '{}',
            'lft' => 1,
            'rgt' => 2,
            'depth' => 0,
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%pages}}');
    }
}

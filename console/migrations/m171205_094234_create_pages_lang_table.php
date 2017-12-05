<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pages_lang`.
 */
class m171205_094234_create_pages_lang_table extends Migration
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
        $this->createTable('{{%pages_lang}}', [
            'id' => $this->primaryKey(),
            'page_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'content' => 'MEDIUMTEXT',
            'meta_json' => 'JSON NOT NULL',
            'language' => $this->string()->notNull()
        ], $tableOptions);

        $this->createIndex('{{%idx-pages_lang-page_id}}', '{{%pages_lang}}', 'page_id');
        $this->createIndex('{{%idx-pages_lang-language}}', '{{%pages_lang}}', 'language');
        $this->addForeignKey(
            '{{%fk-pages_lang-page_id}}',
            '{{%pages_lang}}',
            'page_id',
            '{{%pages}}',
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
        $this->dropTable('{{%pages_lang}}');
    }
}

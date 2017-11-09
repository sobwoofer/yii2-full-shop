<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lang`.
 */
class m171108_155636_create_lang_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%lang}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->notNull(),
            'local' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'default' => $this->smallInteger()->defaultValue(0),
            'date_update' => $this->integer()->notNull(),
            'date_create' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
        ], $tableOptions);

        $this->batchInsert('{{%lang}}', ['url', 'local', 'name', 'default', 'date_update', 'date_create', 'status'], [
            ['en', 'en-US', 'English', 0, time(), time(), 0],
            ['ru', 'ru-RU', 'Русский', 1, time(), time(), 1],
            ['ua', 'uk-UA', 'Русский', 1, time(), time(), 1],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%lang}}');
    }
}

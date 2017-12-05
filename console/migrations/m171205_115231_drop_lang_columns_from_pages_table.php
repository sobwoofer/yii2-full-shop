<?php

use yii\db\Migration;

/**
 * Handles dropping lang from table `pages`.
 */
class m171205_115231_drop_lang_columns_from_pages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('{{%pages}}', 'title');
        $this->dropColumn('{{%pages}}', 'content');
        $this->dropColumn('{{%pages}}', 'meta_json');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('{{%pages}}', 'title', $this->string()->notNull());
        $this->addColumn('{{%pages}}', 'content', 'MEDIUMTEXT');
        $this->addColumn('{{%pages}}', 'meta_json', 'JSON NOT NULL');
    }
}

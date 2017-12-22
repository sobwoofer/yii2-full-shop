<?php

use yii\db\Migration;

/**
 * Handles the creation of table `modification_groups`.
 */
class m171221_100001_create_modification_groups_table extends Migration
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

        $this->createTable('{{%shop_modification_groups}}', [
            'id' => $this->primaryKey(),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'slug' => $this->string()->notNull()->unique(),
            'image' => $this->string(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_modification_groups-slug}}', '{{%shop_modification_groups}}', 'slug');


        $this->createTable('{{%shop_modification_groups_lang}}', [
            'id' => $this->primaryKey(),
            'group_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'language' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_modification_groups_lang-group_id}}', '{{%shop_modification_groups_lang}}', 'group_id');

        $this->addForeignKey(
            '{{%fk-shop_modification_groups_lang-group_id}}',
            '{{%shop_modification_groups_lang}}',
            'group_id',
            '{{%shop_modification_groups}}',
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
        $this->dropTable('{{%shop_modification_groups}}');
        $this->dropTable('{{%shop_modification_groups_lang}}');
    }
}

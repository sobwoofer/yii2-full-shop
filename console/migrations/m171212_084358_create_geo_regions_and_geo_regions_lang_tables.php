<?php

use yii\db\Migration;

/**
 * Class m171212_084358_create_geo_regions_and_geo_regions_lang_tables
 */
class m171212_084358_create_geo_regions_and_geo_regions_lang_tables extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%geo_regions}}', [
            'id' => $this->primaryKey(),
            'country_id' => $this->integer()->notNull(),
            'iso_code' => $this->string()->notNull(),
            'sort' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->execute(file_get_contents(__DIR__ . '/../dumps/regions.sql'));

        $this->addForeignKey(
            '{{%fk-geo_regions-country_id}}',
            '{{%geo_regions}}',
            'country_id',
            '{{%geo_countries}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->createIndex('{{%idx-geo_regions-country_id}}', '{{%geo_regions}}', 'country_id');



        $this->createTable('{{%geo_regions_lang}}', [
            'id' => $this->primaryKey(),
            'region_id' => $this->integer()->notNull(),
            'language' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            '{{%fk-geo_regions_lang-region_id}}',
            '{{%geo_regions_lang}}',
            'region_id',
            '{{%geo_regions}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->createIndex('{{%idx-geo_regions_lang-region_id}}', '{{%geo_regions_lang}}', 'region_id');
        $this->createIndex('{{%idx-geo_regions_lang-language}}', '{{%geo_regions_lang}}', 'language');

        $this->execute(file_get_contents(__DIR__ . '/../dumps/regions_lang.sql'));

    }

    public function down()
    {
        $this->dropTable('{{%geo_regions}}');
        $this->dropTable('{{%geo_regions_lang}}');
    }

}

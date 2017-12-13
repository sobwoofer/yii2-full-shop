<?php

use yii\db\Migration;

/**
 * Class m171212_094917_create_geo_cities_and_geo_cities_lang_tables
 */
class m171212_094917_create_geo_cities_and_geo_cities_lang_tables extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%geo_cities}}', [
            'id' => $this->primaryKey(),
            'region_id' => $this->integer()->notNull(),
            'iso_code' => $this->string()->notNull(),
            'sort' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->execute(file_get_contents(__DIR__ . '/../dumps/cities.sql'));

        $this->addForeignKey(
            '{{%fk-geo_cities-region_id}}',
            '{{%geo_cities}}',
            'region_id',
            '{{%geo_regions}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->createIndex('{{%idx-geo_cities-region_id}}', '{{%geo_cities}}', 'region_id');



        $this->createTable('{{%geo_cities_lang}}', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer()->notNull(),
            'language' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            '{{%fk-geo_cities_lang-city_id}}',
            '{{%geo_cities_lang}}',
            'city_id',
            '{{%geo_cities}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->createIndex('{{%idx-geo_cities_lang-city_id}}', '{{%geo_cities_lang}}', 'city_id');
        $this->createIndex('{{%idx-geo_cities_lang-language}}', '{{%geo_cities_lang}}', 'language');

        $this->execute(file_get_contents(__DIR__ . '/../dumps/cities_lang.sql'));

    }

    public function down()
    {
        $this->dropTable('{{%geo_cities}}');
        $this->dropTable('{{%geo_cities_lang}}');
    }
}

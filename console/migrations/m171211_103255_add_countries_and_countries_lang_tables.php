<?php

use yii\db\Migration;

/**
 * Class m171211_103255_add_contries_regions_cities_tables_and_fill_out_them
 */
class m171211_103255_add_countries_and_countries_lang_tables extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%geo_countries}}', [
            'id' => $this->primaryKey(),
            'lang_id' => $this->integer(),
            'name_iso' => $this->string()->notNull(),
            'a2_iso' => $this->string(2)->notNull(),
            'a3_iso' => $this->string(3)->notNull(),
            'number_iso' => $this->integer()->notNull()
        ], $tableOptions);

        Yii::$app->db->createCommand()->batchInsert('{{%geo_countries}}',
            ['lang_id', 'name_iso', 'a2_iso', 'a3_iso', 'number_iso'], [
                [1, 'UNITED STATES', 'US', 'USA', '840'],
                [2, 'RUSSIAN FEDERATION', 'RU', 'RUS', '643'],
                [2, 'UKRAINE', 'UA', 'UKR', '804'],
                [1, 'CHINA', 'CN', 'CHN', '156'],
        ])->execute();

//        $this->addColumn('{{%lang}}', 'country_id', $this->integer());

        $this->addForeignKey(
            '{{%fk-geo_countries-lang_id}}',
            '{{%geo_countries}}',
            'lang_id',
            '{{%lang}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );


        $this->createTable('{{%geo_countries_lang}}', [
            'id' => $this->primaryKey(),
            'country_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'language' => $this->string()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            '{{%fk-geo_countries_lang-country_id}}',
            '{{%geo_countries_lang}}',
            'country_id',
            '{{%geo_countries}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );


        Yii::$app->db->createCommand()->batchInsert('{{%geo_countries_lang}}',
            ['country_id', 'name', 'language'], [
                [1, 'США', 'ru',],
                [1, 'США', 'ua'],
                [2, 'Россия', 'ru',],
                [2, 'Росія', 'ua'],
                [3, 'Украина', 'ru'],
                [3, 'Україна', 'ua'],
                [4, 'Китай', 'ru'],
                [4, 'Китай', 'ua'],
            ])->execute();


//        $this->execute(file_get_contents(__DIR__ . '/../dumps/world.sql'));

    }

    public function down()
    {
        $this->dropTable('{{%geo_countries_lang}}');
        $this->dropTable('{{%geo_countries}}');
    }

}

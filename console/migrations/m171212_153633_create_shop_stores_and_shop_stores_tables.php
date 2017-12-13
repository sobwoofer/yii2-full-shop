<?php

use yii\db\Migration;

/**
 * Class m171212_160958_create_shop_stores_and_shop_stores_tables
 */
class m171212_153633_create_shop_stores_and_shop_stores_tables extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%shop_stores}}', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer()->notNull(),
            'slug' => $this->string()->notNull(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'work_weekdays' => $this->string()->notNull(),
            'work_weekend' => $this->string()->notNull(),
            'photo' => $this->string(),
        ], $tableOptions);

        $this->addForeignKey(
            '{{%fk-shop_stores-city_id}}',
            '{{%shop_stores}}',
            'city_id',
            '{{%geo_cities}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->createIndex('{{%idx-shop_stores-city_id}}', '{{%shop_stores}}', 'city_id');

        Yii::$app->db->createCommand()->batchInsert('{{%shop_stores}}',
            ['city_id', 'slug', 'phone', 'email', 'work_weekdays', 'work_weekend', 'photo'], [
                [4098, 'store-vyshneve', '+38 (044) 501 88 62', 'vyshneve@papyrus.com.ua', '9:00 - 20:00', '10:00 - 18:00', null],
                [3897, 'store-dnepr', '+38 (056) 375-74-24', 'dnipro@papirus.ua', '9:00 - 20:00', '10:00 - 18:00', null]
            ])->execute();

        $this->createTable('{{%shop_stores_lang}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'language' => $this->string()->notNull(),
            'store_id' => $this->integer()->notNull(),
            'description' => $this->text(),

        ], $tableOptions);

        $this->addForeignKey(
            '{{%fk-shop_stores_lang-store_id}}',
            '{{%shop_stores_lang}}',
            'store_id',
            '{{%shop_stores}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->createIndex('{{%idx-shop_stores_lang-store_id}}', '{{%shop_stores_lang}}', 'store_id');

        Yii::$app->db->createCommand()->batchInsert('{{%shop_stores_lang}}',
            ['name', 'address', 'language', 'store_id', 'description'], [
                ['Магазин канцтоваров и деловых подарков, товаров для школы, творчества и развития. Офисные кресла и мебель.', 'Вишневое Киевская 2а', 'ru', 1, null],
                ['Магазин канцтоварів і ділових подарунків, товарів для школи, творчості та розвитку. Офісні крісла та меблі.', 'Вишневое Київська 2а', 'ua', 1, null],
                ['Магазин в г. Днепр', 'Проспект Александра Поля, 59', 'ru', 2, null],
                ['Магазин в м. Дніпро', 'Проспект Олександра Поля, 59', 'ua', 2, null]
            ])->execute();
    }

    public function down()
    {
        $this->dropTable('{{%shop_stores}}');
    }

}

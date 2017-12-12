<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_warehouses`.
 */
class m171212_122729_create_shop_warehouses_and_shop_warehouses_lang_tables extends Migration
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

        $this->createTable('{{%shop_warehouses}}', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer()->notNull(),
            'min_order' => $this->float()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            '{{%fk-shop_warehouses-city_id}}',
            '{{%shop_warehouses}}',
            'city_id',
            '{{geo_cities}}',
            'id',
            'RESTRICT',
            'RESTRICT'
            );

        $this->createIndex('{{%idx-shop_warehouses-city_id}}', '{{%shop_warehouses}}', 'city_id');

        Yii::$app->db->createCommand()->batchInsert('{{%shop_warehouses}}',
            ['id', 'city_id', 'min_order'], [
            [1, 4098, 750],
            [2, 3897, 500]
        ])->execute();

        $this->createTable('{{%shop_warehouses_lang}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'language' => $this->string()->notNull(),
            'warehouse_id' => $this->integer()->notNull(),
            'description' => $this->text(),

        ], $tableOptions);

        $this->addForeignKey(
            '{{%fk-shop_warehouses_lang-warehouse_id}}',
            '{{%shop_warehouses_lang}}',
            'warehouse_id',
            '{{shop_warehouses}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->createIndex('{{%idx-shop_warehouses_lang-warehouse_id}}', '{{%shop_warehouses_lang}}', 'warehouse_id');

        Yii::$app->db->createCommand()->batchInsert('{{%shop_warehouses_lang}}',
            ['name', 'address', 'language', 'warehouse_id', 'description'], [
                ['Склад в Киеве', 'Вишневое Киевская 2а', 'ru', 1, null],
                ['Склад в Києві', 'Вишневое Київська 2а', 'ua', 1, null],
                ['Склад в Днепре', 'Проспект Александра Поля, 59', 'ru', 2, null],
                ['Склад в Дніпрі', 'Проспект Олександра Поля, 59', 'ua', 2, null]
            ])->execute();

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%shop_warehouses}}');
        $this->dropTable('{{%shop_warehouses_lang}}');
    }
}

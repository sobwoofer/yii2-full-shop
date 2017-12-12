<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_give_points`.
 */
class m171212_153633_create_shop_give_points_and_shop_give_points_lang_tables extends Migration
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

        $this->createTable('{{%shop_give_points}}', [
            'id' => $this->primaryKey(),
            'warehouse_id' => $this->integer()->notNull(),
            'store_id' => $this->integer(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'work_weekdays' => $this->string()->notNull(),
            'work_weekend' => $this->string()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            '{{%fk-shop_give_points-warehouse_id}}',
            '{{%shop_give_points}}',
            'warehouse_id',
            '{{shop_warehouses}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->createIndex('{{%idx-shop_give_points-warehouse_id}}', '{{%shop_give_points}}', 'warehouse_id');

        Yii::$app->db->createCommand()->batchInsert('{{%shop_give_points}}',
            ['warehouse_id', 'phone', 'email', 'work_weekdays', 'work_weekend'], [
                [1, '+38 (044) 501 88 62', 'vyshneve@papyrus.com.ua', '9:00 - 20:00', '10:00 - 18:00'],
                [2, '+38 (056) 375-74-24', 'dnipro@papirus.ua', '9:00 - 20:00', '10:00 - 18:00']
            ])->execute();

        $this->createTable('{{%shop_give_points_lang}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'language' => $this->string()->notNull(),
            'give_points_id' => $this->integer()->notNull(),
            'description' => $this->text(),

        ], $tableOptions);

        $this->addForeignKey(
            '{{%fk-shop_give_points_lang-give_points_id}}',
            '{{%shop_give_points_lang}}',
            'give_points_id',
            '{{shop_give_points}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->createIndex('{{%idx-shop_give_points_lang-give_points_id}}', '{{%shop_give_points_lang}}', 'give_points_id');

        Yii::$app->db->createCommand()->batchInsert('{{%shop_give_points_lang}}',
            ['name', 'address', 'language', 'give_points_id', 'description'], [
                ['Пункт выдачи в Вешневом', 'Вишневое Киевская 2а', 'ru', 1, null],
                ['Пункт видачі у Вешневому', 'Вишневое Київська 2а', 'ua', 1, null],
                ['Пункт выдачи в Вешневом Днепре', 'Проспект Александра Поля, 59', 'ru', 2, null],
                ['Пункт видачі у Дніпрі', 'Проспект Олександра Поля, 59', 'ua', 2, null]
            ])->execute();
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%shop_give_points}}');
        $this->dropTable('{{%shop_give_points_lang}}');
    }
}

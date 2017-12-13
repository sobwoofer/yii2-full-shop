<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_give_points`.
 */
class m171212_160958_create_shop_give_points_and_shop_give_points_lang_tables extends Migration
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
            'store_id' => $this->integer()->notNull(),
            'slug' => $this->string()->notNull(),
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

        $this->addForeignKey(
            '{{%fk-shop_give_points-store_id}}',
            '{{%shop_give_points}}',
            'store_id',
            '{{shop_stores}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->createIndex('{{%idx-shop_give_points-warehouse_id}}', '{{%shop_give_points}}', 'warehouse_id');
        $this->createIndex('{{%idx-shop_give_points-store_id}}', '{{%shop_give_points}}', 'store_id');

        Yii::$app->db->createCommand()->batchInsert('{{%shop_give_points}}',
            ['warehouse_id', 'store_id', 'slug'], [
                [1, 1, 'give-point-veshneve'],
                [2, 2, 'give-point-dnepr']
            ])->execute();

        $this->createTable('{{%shop_give_points_lang}}', [
            'id' => $this->primaryKey(),
            'give_point_id' => $this->integer()->notNull(),
            'language' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),

        ], $tableOptions);

        $this->addForeignKey(
            '{{%fk-shop_give_points_lang-give_point_id}}',
            '{{%shop_give_points_lang}}',
            'give_point_id',
            '{{shop_give_points}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );

        $this->createIndex('{{%idx-shop_give_points_lang-give_point_id}}', '{{%shop_give_points_lang}}', 'give_point_id');

        Yii::$app->db->createCommand()->batchInsert('{{%shop_give_points_lang}}',
            ['name', 'language', 'give_point_id', 'description'], [
                ['Пункт выдачи в Вешневом', 'ru', 1, null],
                ['Пункт видачі у Вешневому', 'ua', 1, null],
                ['Пункт выдачи в Вешневом Днепре', 'ru', 2, null],
                ['Пункт видачі у Дніпрі', 'ua', 2, null]
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

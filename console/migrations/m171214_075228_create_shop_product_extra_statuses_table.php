<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_product_statuses`.
 */
class m171214_075228_create_shop_product_extra_statuses_table extends Migration
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

        $this->createTable('{{%shop_product_extra_statuses}}', [
            'id' => $this->primaryKey(),
            'external_id' => $this->integer()->unique(),
            'slug' =>$this->string()->unique()->notNull()
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_product_extra_statuses-external_id}}', '{{%shop_product_extra_statuses}}', 'external_id');

        Yii::$app->db->createCommand()->batchInsert('{{%shop_product_extra_statuses}}',
            ['external_id', 'slug'], [
                [1, 'availability'],
                [2, 'expected'],
                [3, 'ends'],
                [4, 'many'],
                [6, 'for-order'],
                [8, 'discontinued']
            ])->execute();

        $this->createTable('{{%shop_product_extra_statuses_lang}}', [
            'id' => $this->primaryKey(),
            'extra_status_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'language' =>$this->string()->notNull()
        ], $tableOptions);



        $this->createIndex('{{%idx-shop_product_extra_statuses_lang-extra_status_id}}', '{{%shop_product_extra_statuses_lang}}', 'extra_status_id');

        $this->addForeignKey(
            '{{%fk-shop_product_extra_statuses_lang-extra_status_id}}',
            '{{%shop_product_extra_statuses_lang}}',
            'extra_status_id',
            '{{shop_product_extra_statuses}}',
            'id'
        );

        Yii::$app->db->createCommand()->batchInsert('{{%shop_product_extra_statuses_lang}}',
            ['extra_status_id', 'name', 'language'], [
                [1, 'Есть в наличии', 'ru'],
                [1, 'Є в наявності', 'ua'],
                [2, 'Ожидается', 'ru'],
                [2, 'Очікується', 'ua'],
                [3, 'Заканчивается', 'ru'],
                [3, 'Закінчується', 'ua'],
                [4, 'Товара много', 'ru'],
                [4, 'Товару багато', 'ua'],
                [5, 'Под заказ', 'ru'],
                [5, 'Під замовлення', 'ua'],
                [6, 'Снят с продаж', 'ru'],
                [6, 'Знятий з продажу', 'ua']
            ])->execute();

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%shop_product_extra_statuses}}');
        $this->dropTable('{{%shop_product_extra_statuses_lang}}');
    }
}

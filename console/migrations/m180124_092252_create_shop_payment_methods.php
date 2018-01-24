<?php

use yii\db\Migration;

/**
 * Class m180124_092252_create_shop_payment_methods
 */
class m180124_092252_create_shop_payment_methods extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%shop_payment_methods}}', [
            'id' => $this->primaryKey(),
            'warehouse_id' => $this->integer(),
            'active' => $this->string()->notNull(),
            'max_cost' => $this->float(),
            'min_cost' => $this->float(),

        ], $tableOptions);

        $this->createIndex('{{%idx-shop_payment_methods-warehouse_id}}', '{{%shop_payment_methods}}', 'warehouse_id');

        $this->createTable('{{%shop_payment_methods_lang}}', [
        'id' => $this->primaryKey(),
        'payment_method_id' => $this->integer()->notNull(),
        'name' => $this->string()->notNull(),
        'description' => $this->text(),
        'language' => $this->string()->notNull(),
    ], $tableOptions);

        $this->createIndex('{{%idx-shop_payment_methods_lang-payment_method_id}}', '{{%shop_payment_methods_lang}}', 'payment_method_id');

        $this->addForeignKey(
            '{{%fk-shop_payment_methods_lang-payment_method_id}}',
            '{{%shop_payment_methods_lang}}',
            'payment_method_id',
            '{{%shop_payment_methods}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

    }

    public function down()
    {
        $this->dropTable('{{%shop_payment_methods}}');
    }

}

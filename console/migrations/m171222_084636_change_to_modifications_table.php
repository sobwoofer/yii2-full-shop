<?php

use yii\db\Migration;

/**
 * Class m171222_084636_change_to_modifications_table
 */
class m171222_084636_change_to_modifications_table extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->dropIndex('{{%idx-shop_modifications-product_id-code}}', '{{%shop_modifications}}');
        $this->dropForeignKey('{{%fk-shop_modifications-product_id}}', '{{%shop_modifications}}');
        $this->dropIndex('{{%idx-shop_modifications-product_id}}', '{{%shop_modifications}}');

        $this->dropColumn('{{%shop_modifications}}', 'name');
        $this->dropColumn('{{%shop_modifications}}', 'product_id');
        $this->dropColumn('{{%shop_modifications}}', 'quantity');

        $this->addColumn('{{%shop_modifications}}', 'case_code', $this->string());
        $this->addColumn('{{%shop_modifications}}', 'manager_id', $this->integer());
        $this->addColumn('{{%shop_modifications}}', 'group_id', $this->integer());
        $this->addColumn('{{%shop_modifications}}', 'status', $this->smallInteger(1)->notNull()->defaultValue(1));

        $this->createIndex('{{%idx-shop_modifications-case_code}}', '{{%shop_modifications}}', 'case_code');

        $this->addForeignKey(
            '{{%fk-shop_modifications-manager_id}}',
            '{{%shop_modifications}}',
            'manager_id',
            '{{%users}}',
            'id'
        );

        $this->addForeignKey(
            '{{%fk-shop_modifications-group_id}}',
            '{{%shop_modifications}}',
            'group_id',
            '{{%shop_modification_groups}}',
            'id'
        );


        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%shop_modifications_lang}}', [
            'id' => $this->primaryKey(),
            'modification_id' => $this->integer()->notNull(),
            'language' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_modifications_lang-modification_id}}', '{{%shop_modifications_lang}}', 'modification_id');

        $this->addForeignKey(
            '{{%fk-shop_modifications_lang-modification_id}}',
            '{{%shop_modifications_lang}}',
            'modification_id',
            '{{%shop_modifications}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

    }

    public function down()
    {
        return false;
    }

}

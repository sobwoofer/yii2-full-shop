<?php

use yii\db\Migration;

/**
 * Class m170814_073920_shop_brands_table
 */
class m170814_073920_shop_brands_table extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%shop_brands}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'meta_json' => 'JSON NOT NULL',
        ], $tableOptions);

        $this->createIndex('{{%idx-shop_brands-slug}}', '{{%shop_brands}}','slug', true);
    }

    public function down()
    {
        $this->dropTable('{{%shop_brands}}');
    }

}

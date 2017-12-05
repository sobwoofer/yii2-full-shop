<?php

use yii\db\Migration;

/**
 * Class m171205_133736_add_indexes_and_foreign_keys_to_brands_lang_table
 */
class m171205_133736_add_indexes_and_foreign_keys_to_brands_lang_table extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createIndex('{{%idx-shop_brands_lang-brand_id}}', '{{%shop_brands_lang}}', 'brand_id');
        $this->createIndex('{{%idx-shop_brands_lang-language}}', '{{%shop_brands_lang}}', 'language');
        $this->addForeignKey(
            '{{%fk-shop_brands_lang-brand_id}}',
            '{{%shop_brands_lang}}',
            'brand_id',
            '{{%shop_brands}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

    }

    public function down()
    {
        $this->dropIndex('{{%idx-shop_brands_lang-brand_id}}', '{{%shop_brands_lang}}');
        $this->dropIndex('{{%idx-shop_brands_lang-language}}', '{{%shop_brands_lang}}');
        $this->dropForeignKey('{{%fk-shop_brands_lang-brand_id}}', '{{%shop_brands_lang}}');
    }

}

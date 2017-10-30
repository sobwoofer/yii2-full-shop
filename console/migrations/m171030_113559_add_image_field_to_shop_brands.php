<?php

use yii\db\Migration;

class m171030_113559_add_image_field_to_shop_brands extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%shop_brands}}', 'image', $this->string());

    }

    public function down()
    {
        $this->dropColumn('{{%shop_brands}}', 'image');
    }

}

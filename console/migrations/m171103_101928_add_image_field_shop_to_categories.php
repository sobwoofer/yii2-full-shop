<?php

use yii\db\Migration;

class m171103_101928_add_image_field_shop_to_categories extends Migration
{

    public function up()
    {
        $this->addColumn('{{%shop_categories}}', 'image', $this->string());
    }

    public function down()
    {
        $this->dropColumn('{{%shop_categories}}', 'image');
    }

}

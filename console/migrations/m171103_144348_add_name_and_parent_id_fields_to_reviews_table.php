<?php

use yii\db\Migration;

class m171103_144348_add_name_and_parent_id_fields_to_reviews_table extends Migration
{

    public function up()
    {
        $this->addColumn('{{%shop_reviews}}', 'parent_id', $this->integer());
        $this->addColumn('{{%shop_reviews}}', 'username', $this->string());
    }

    public function down()
    {
        $this->dropColumn('{{shop_reviews}}', 'parent_id');
        $this->dropColumn('{{shop_reviews}}', 'username');
    }

}

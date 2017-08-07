<?php

use yii\db\Migration;

class m170804_085537_add_user_email_confirm_token extends Migration
{
    /**
     * add column email_confirm_token in the table user
     * after column email
     */
    public function up()
    {
        $this->addColumn('{{%user%}}', 'email_confirm_token', $this->string()->unique()->after('email'));
    }

    /**
     * drop this column if this migrate been backup
     */
    public function down()
    {
       $this->dropColumn('{{user}}', 'email_confirm_token');
    }
}

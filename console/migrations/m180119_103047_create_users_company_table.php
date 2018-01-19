<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users_company`.
 */
class m180119_103047_create_users_company_table extends Migration
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

        $this->createTable('{{%users_company}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'company_name' => $this->string()->notNull(),
            'company_tax_code' => $this->integer()->notNull(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string(),
            'address' => $this->string(),
        ], $tableOptions);

        $this->createIndex('{{%idx-users_company-user_id}}', '{{%users_company}}', 'user_id');


        $this->addForeignKey(
            '{{%fk-users_company-user_id}}',
            '{{%users_company}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%users_company}}');
    }
}

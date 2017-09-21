<?php

use yii\db\Migration;

/**
 * Изменяем стандартную йишную миграцию для связей в таблице к RBAC. user_id должен быть только интеджер
 * тогда сможем накинуть внешний ключ таблицы связи ролей на таблицу юзеров, проставить каскадное удаление
 * связей с удалением юзера чтобы не хранить мусор. И проставляем индекс на это поле.
 *
 * Class m170921_104840_change_auth_assignments_table
 */
class m170921_104840_change_auth_assignments_table extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%auth_assignments}}', 'user_id', $this->integer()->notNull());

        $this->createIndex('{{%idx-auth_assignments-user_id}}', '{{%auth_assignments}}', 'user_id');

        $this->addForeignKey('{{%fk-auth_assignments-user_id}}', '{{%auth_assignments}}', 'user_id', '{{%users}}', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('{{%fk-auth_assignments-user_id}}', '{{%auth_assignments}}');

        $this->dropIndex('{{%idx-auth_assignments-user_id}}', '{{%auth_assignments}}');

        $this->alterColumn('{{%auth_assignments}}', 'user_id', $this->string(64)->notNull());
    }
}

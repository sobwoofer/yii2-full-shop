<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 22.01.18
 * Time: 11:33
 */

namespace core\entities\User\queries;


use yii\db\ActiveQuery;

class UserQuery extends ActiveQuery
{
    public $type;

    public function prepare($builder)
    {
//        var_dump($this);
//        die();
//        if ($this->type !== null) {
//            $this->andWhere(["$this->tableName.type" => $this->type]);
//        }
        $this->andWhere(['type' => $this->type]);
//        var_dump('ss');
//        die();
        return parent::prepare($builder);
    }



}
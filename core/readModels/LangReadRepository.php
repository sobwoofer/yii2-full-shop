<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 09.11.17
 * Time: 12:59
 */

namespace core\readModels;


use core\entities\Lang;

class LangReadRepository
{
    public function findAllActive()
    {
        return Lang::find()->andWhere(['status' => true])->all();
    }

    public function getDefault()
    {
        return Lang::find()->andWhere(['default' => 1])->one();
    }

    public function findAll()
    {
        return Lang::find()->all();
    }

    public function find($id)
    {
        return Lang::findOne($id);
    }

}
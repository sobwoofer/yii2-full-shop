<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.08.17
 * Time: 13:26
 */

namespace core\entities\Shop\queries;


use paulzi\nestedsets\NestedSetsQueryTrait;
use yii\db\ActiveQuery;
use omgdef\multilingual\MultilingualTrait;

class CategoryQuery extends ActiveQuery
{
    //use Trait of plugin instead overwrite find() method in the entity how wrote in plugin instruction.
    use MultilingualTrait;

    //use for assign categories tree
   use NestedSetsQueryTrait;

}
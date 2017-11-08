<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 18.09.17
 * Time: 11:51
 */

namespace core\entities\Blog\Post\queries;

use core\entities\Blog\Post\Post;
use yii\db\ActiveQuery;
use omgdef\multilingual\MultilingualQuery;
use omgdef\multilingual\MultilingualTrait;

class PostQuery extends ActiveQuery
{
    //use Trait of plugin instead overwrite find() method in the entity how wrote in plugin instruction.
    use MultilingualTrait;

    /**
     * @param null $alias
     * @return $this
     */
    public function active($alias = null)
    {
        return $this->andWhere([
            ($alias ? $alias . '.' : '') . 'status' => Post::STATUS_ACTIVE,
        ]);
    }


}
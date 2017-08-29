<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 10.08.17
 * Time: 17:27
 */

namespace core\repositories\Shop;


use core\entities\Shop\Tag;
use core\repositories\NotFoundException;

class TagRepository
{
    public function get($id): Tag
    {
        if(!$tag = Tag::findOne($id)){
            throw new NotFoundException('Tag is not found.');
        }
        return $tag;
    }

    public function findByName($name): ?Tag
    {
        return Tag::findOne(['name' => $name]);
    }

    public function save(Tag $tag):void
    {
        if (!$tag->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Tag $tag): void
    {
        if (!$tag->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

}
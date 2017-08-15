<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.08.17
 * Time: 13:54
 */

namespace shop\repositories\Shop;


use shop\entities\Shop\Category;
use shop\repositories\NotFoundException;

class CategoryRepository
{
    public function get($id): Category
    {
        if (!$category = Category::findOne($id)) {
            throw new NotFoundException('Category is not found');
        }
        return $category;
    }

    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new \RuntimeException('saving error.');
        }
    }

    public function remove(Category $category): void
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.09.17
 * Time: 12:32
 */

namespace core\repositories\Blog;


use core\entities\Blog\Category;
use core\repositories\NotFoundException;

class CategoryRepository
{
    public function get($id): Category
    {
        if (!$category = Category::find()->multilingual()->andWhere(['id' => $id])->one()) {
            throw new NotFoundException('Category is not found.');
        }
        return $category;
    }

    public function save(Category $category)
    {

        if (!$category->save()) {
            throw new \RuntimeException('Saving error');
        }
    }

    public function remove(Category $category)
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

}
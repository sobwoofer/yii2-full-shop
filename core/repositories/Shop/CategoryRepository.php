<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.08.17
 * Time: 13:54
 */

namespace core\repositories\Shop;


use core\entities\Shop\Category\Category;
use core\repositories\NotFoundException;
use core\dispatchers\EventDispatcher;
use core\repositories\events\EntityPersisted;
use core\repositories\events\EntityRemoved;

class CategoryRepository
{
    private $dispatcher;

    public function __construct(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function get($id): Category
    {
        if (!$category = Category::find()->multilingual()->andWhere(['id' => $id])->one()) {
            throw new NotFoundException('Category is not found');
        }
        return $category;
    }

    public function save(Category $category): void
    {
        if (!$category->save()) {
            throw new \RuntimeException('saving error.');
        }
        $this->dispatcher->dispatch(new EntityPersisted($category));
    }

    public function remove(Category $category): void
    {
        if (!$category->delete()) {
            throw new \RuntimeException('Removing error.');
        }
        $this->dispatcher->dispatch(new EntityRemoved($category));
    }


}
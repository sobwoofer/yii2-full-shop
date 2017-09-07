<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 07.09.17
 * Time: 15:49
 */


namespace core\readModels\Shop\views;

use core\entities\Shop\Category;

class CategoryView
{
    public $category;
    public $count;

    public function __construct(Category $category, $count)
    {
        $this->category = $category;
        $this->count = $count;
    }
}
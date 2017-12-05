<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 31.10.17
 * Time: 15:47
 */

namespace core\readModels\Shop\views;


use core\entities\Shop\Category\Category;

class CatalogMenuView
{
    public $category;
    public $_children;

    public function __construct(Category $category)
    {
        $this->category = $category;

    }

    public function addChild(Category $child)
    {
        return $this->_children[] = new self($child);
    }

}
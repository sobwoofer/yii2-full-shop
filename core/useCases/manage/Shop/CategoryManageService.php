<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.08.17
 * Time: 14:18
 */

namespace core\useCases\manage\Shop;

use core\entities\Meta;
use core\entities\Shop\Category\Category;
use core\entities\Shop\Product\Product;
use core\forms\manage\Shop\CategoryForm;
use core\repositories\Shop\CategoryRepository;
use core\repositories\Shop\ProductRepository;
use yii\helpers\Inflector;
use core\helpers\LangsHelper;

class CategoryManageService
{
    private $categories;
    private $products;

    public function __construct(CategoryRepository $categories, ProductRepository $products)
    {
        $this->categories = $categories;
        $this->products = $products;
    }

    public function create(CategoryForm $form): Category
    {
        $parent = $this->categories->get($form->parentId);
        $names = [];
        $titles = [];
        $descriptions = [];
        $metas = [];
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $titles['title' . $suffix] = $form->{'title' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
            $metas['meta' . $suffix] = new Meta(
                $form->{'meta' . $suffix}->{'title' . $suffix},
                $form->{'meta' . $suffix}->{'description' . $suffix},
                $form->{'meta' . $suffix}->{'keywords' . $suffix}
            );
        }

        $category = Category::create(
            $names,
            $titles,
            $descriptions,
            $metas,
            $form->slug ?: Inflector::slug($form->name)
        );
        $category->appendTo($parent);
        if ($form->image) {
            $category->setPhoto($form->image);
        }
        $this->categories->save($category);
        return $category;
    }

    public function edit($id, CategoryForm $form): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);

        $names = [];
        $titles = [];
        $descriptions = [];
        $metas = [];
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $titles['title' . $suffix] = $form->{'title' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
            $metas['meta' . $suffix] = new Meta(
                $form->{'meta' . $suffix}->{'title' . $suffix},
                $form->{'meta' . $suffix}->{'description' . $suffix},
                $form->{'meta' . $suffix}->{'keywords' . $suffix}
            );
        }

        $category->edit(
            $names,
            $titles,
            $descriptions,
            $metas,
            $form->slug ?: Inflector::slug($form->name)
        );
        if ($form->parentId !== $category->parent->id) {
            $parent = $this->categories->get($form->parentId);
            $category->appendTo($parent);
        }
        if ($form->image) {
            $category->setPhoto($form->image);
        }
        $this->categories->save($category);
    }

    public function moveUp($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($prev = $category->prev) {
            $category->insertBefore($prev);
        }
        $this->categories->save($category);

    }

    public function moveDown($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($next = $category->next) {
            $category->insertAfter($next);
        }
        $this->categories->save($category);
    }

    public function remove($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($this->products->existByMainCategory($category->id)) {
            throw new \DomainException('Unable to remove category with products');
        }
        $this->categories->remove($category);
    }

    private function assertIsNotRoot(Category $category): void
    {
        if ($category->isRoot()) {
            throw new \DomainException('Unable to manage the root category.');
        }
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.09.17
 * Time: 13:06
 */

namespace core\useCases\manage\Blog;


use core\entities\Blog\Category;
use core\entities\Meta;
use core\forms\manage\MetaForm;
use core\repositories\Blog\CategoryRepository;
use core\forms\manage\Blog\CategoryForm;
use core\repositories\Blog\PostRepository;
use yii\helpers\Inflector;

class CategoryManageService
{
    private $categories;
    private $posts;

    public function __construct(CategoryRepository $categories, PostRepository $posts)
    {
        $this->categories = $categories;
        $this->posts = $posts;
    }

    /**
     * @param CategoryForm $form
     * @return Category
     */
    public function create(CategoryForm $form): Category
    {
        $category = Category::create(
            $form->name,
            $form->slug ?: Inflector::slug($form->name),
            $form->title,
            $form->description,
            $form->sort,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->categories->save($category);
        return $category;
    }

    public function edit($id, CategoryForm $form): void
    {
        $category = $this->categories->get($id);
        $category->edit(
            $form->name,
            $form->slug ?: Inflector::slug($form->name),
            $form->title,
            $form->description,
            $form->sort,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );
        $this->categories->save($category);
    }

    public function remove($id): void
    {
        $category = $this->categories->get($id);
        if ($this->posts->existsByCategory($category->id)) {
            throw new \DomainException('Unable to remove category with posts.');
        }
        $this->categories->remove($category);
    }
}
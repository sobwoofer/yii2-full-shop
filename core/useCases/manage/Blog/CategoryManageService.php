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
use core\helpers\LangsHelper;

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
        $names = [];
        $titles = [];
        $descriptions = [];
        $metas = [];

        //fulled variables of multi lang data
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
            $form->slug ?: Inflector::slug($form->name),
            $form->sort,
            $names,
            $titles,
            $descriptions,
            $metas
        );


        $this->categories->save($category);
        return $category;
    }

    public function edit($id, CategoryForm $form): void
    {

        $names = [];
        $titles = [];
        $descriptions = [];
        $metas = [];



        //fulled variables of multi lang data
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

        $category = $this->categories->get($id);
        $category->edit(
            $form->slug ?: Inflector::slug($form->name),
            $form->sort,
            $names,
            $titles,
            $descriptions,
            $metas
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
<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.10.17
 * Time: 16:38
 */

namespace frontend\widgets\Blog;


use yii\base\Widget;
use core\readModels\Blog\PostReadRepository;
use core\readModels\Blog\CategoryReadRepository;

class ArticlesWidget extends Widget
{
    private $posts;
    private $categories;
    public $limit;
    public $categoryId = 3;
    public $title;

    public function __construct(PostReadRepository $posts, CategoryReadRepository $categories, array $config = [])
    {
        parent::__construct($config);
        $this->posts = $posts;
        $this->categories = $categories;
    }

    public function run()
    {
        $category = $this->categories->find($this->categoryId);
        return $this->render('articles', [
            'posts' => $this->posts->getLastByCategory($category, $this->limit),
            'title' => $this->title ??  $category->name,
            'categorySlug' => $category->slug,
        ]);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 20.09.17
 * Time: 10:23
 */

namespace frontend\widgets\Blog;


use core\readModels\Blog\CategoryReadRepository;
use core\readModels\Blog\PostReadRepository;
use yii\base\Widget;

class LastPostsWidget extends Widget
{
    public $limit;
    public $categoryFirstId = 1;
    public $categorySecondId = 2;
    private $posts;
    private $categories;

    public function __construct(PostReadRepository $posts, CategoryReadRepository $categories, array $config = [])
    {
        parent::__construct($config);
        $this->posts = $posts;
        $this->categories = $categories;
    }

    public function run()
    {
        $firstCategory = $this->categories->find($this->categoryFirstId);
        $secondCategory = $this->categories->find($this->categorySecondId);

        return $this->render('last-posts', [
            'firstCategory' => $firstCategory,
            'secondCategory' => $secondCategory,
            'firstPosts' => $this->posts->getLastByCategory($firstCategory, $this->limit),
            'secondPosts' => $this->posts->getLastByCategory($secondCategory, $this->limit),
        ]);
    }

}
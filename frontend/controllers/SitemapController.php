<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.10.17
 * Time: 17:02
 */


namespace frontend\controllers;

use core\entities\Blog\Category as BlogCategory;
use core\entities\Blog\Post\Post;
use core\entities\Page\Page;
use core\entities\Shop\Category as ShopCategory;
use core\entities\Shop\Product\Product;
use core\readModels\Blog\CategoryReadRepository as BlogCategoryReadRepository;
use core\readModels\Blog\PostReadRepository;
use core\readModels\PageReadRepository;
use core\readModels\Shop\CategoryReadRepository as ShopCategoryReadRepository;
use core\readModels\Shop\ProductReadRepository;
use core\services\sitemap\IndexItem;
use core\services\sitemap\MapItem;
use core\services\sitemap\Sitemap;
use yii\caching\Dependency;
use yii\caching\TagDependency;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

class SitemapController extends Controller
{
    const ITEMS_PER_PAGE = 100;

    private $sitemap;
    private $pages;
    private $blogCategories;
    private $posts;
    private $shopCategories;
    private $products;

    public function __construct(
        $id,
        $module,
        Sitemap $sitemap,
        PageReadRepository $pages,
        BlogCategoryReadRepository $blogCategories,
        PostReadRepository $posts,
        ShopCategoryReadRepository $shopCategories,
        ProductReadRepository $products,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->sitemap = $sitemap;
        $this->pages = $pages;
        $this->blogCategories = $blogCategories;
        $this->posts = $posts;
        $this->shopCategories = $shopCategories;
        $this->products = $products;
    }

    public function actionIndex(): Response
    {
        return $this->renderSitemap('sitemap-index', function () {
            return $this->sitemap->generateIndex([
                new IndexItem(Url::to(['pages'], true)),
                new IndexItem(Url::to(['blog-categories'], true)),
                new IndexItem(Url::to(['blog-posts-index'], true)),
                new IndexItem(Url::to(['shop-categories'], true)),
                new IndexItem(Url::to(['shop-products-index'], true)),
            ]);
        });
    }

    public function actionPages(): Response
    {
        return $this->renderSitemap('sitemap-pages', function () {
            return $this->sitemap->generateMap(array_map(function (Page $page) {
                return new MapItem(
                    Url::to(['/page/view', 'id' => $page->id], true),
                    null,
                    MapItem::WEEKLY
                );
            }, $this->pages->getAll()));
        });
    }

    public function actionBlogCategories(): Response
    {
        return $this->renderSitemap('sitemap-blog-categories', function () {
            return $this->sitemap->generateMap(array_map(function (BlogCategory $category) {
                return new MapItem(
                    Url::to(['/blog/posts/category', 'slug' => $category->slug], true),
                    null,
                    MapItem::WEEKLY
                );
            }, $this->blogCategories->getAll()));
        });
    }

    public function actionBlogPostsIndex(): Response
    {
        return $this->renderSitemap('sitemap-blog-posts-index', function (){
            return $this->sitemap->generateIndex(array_map(function ($start) {
                return new IndexItem(Url::to(['blog-posts', 'start' => $start * self::ITEMS_PER_PAGE], true));
            }, range(0, (int)($this->posts->count() / self::ITEMS_PER_PAGE))));
        });
    }

    public function actionBlogPosts($start = 0): Response
    {
        return $this->renderSitemap(['sitemap-blog-posts', $start], function () use ($start) {
            return $this->sitemap->generateMap(array_map(function (Post $post) {
                return new MapItem(
                    Url::to(['/blog/post/post', 'id' => $post->id], true),
                    null,
                    MapItem::DAILY
                );
            }, $this->posts->getAllByRange($start, self::ITEMS_PER_PAGE)));
        });
    }

    public function actionShopCategories(): Response
    {
        return $this->renderSitemap('sitemap-blog-categories', function () {
            return $this->sitemap->generateMap(array_map(function (ShopCategory $category) {
                return new MapItem(
                    Url::to(['/shop/catalog/category', 'id' => $category->id], true),
                    null,
                    MapItem::WEEKLY
                );
            }, $this->shopCategories->getAll()));
        }, new TagDependency(['tags' => ['categories']]));
    }

    public function actionShopProductsIndex(): Response
    {
        return $this->renderSitemap('sitemap-shop-products-index', function (){
            return $this->sitemap->generateIndex(array_map(function ($start) {
                return new IndexItem(Url::to(['shop-products', 'start' => $start * self::ITEMS_PER_PAGE], true));
            }, range(0, (int)($this->products->count() / self::ITEMS_PER_PAGE))));
        }, new TagDependency(['tags' => ['products']]));
    }

    public function actionShopProducts($start = 0): Response
    {
        return $this->renderSitemap(['sitemap-shop-products', $start], function () use ($start) {
            return $this->sitemap->generateMap(array_map(function (Product $product) {
                return new MapItem(
                    Url::to(['/shop/catalog/product', 'id' => $product->id], true),
                    null,
                    MapItem::DAILY
                );
            }, $this->products->getAllByRange($start, self::ITEMS_PER_PAGE)));
        }, new TagDependency(['tags' => ['products']]));
    }

    private function renderSitemap($key, callable $callback, Dependency $dependency = null): Response
    {
        return \Yii::$app->response->sendContentAsFile(\Yii::$app->cache->getOrSet($key, $callback, null, $dependency), Url::canonical(), [
            'mimeType' => 'application/xml',
            'inline' => true
        ]);
    }
}
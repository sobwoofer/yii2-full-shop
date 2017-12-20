<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 20.12.17
 * Time: 15:00
 */

namespace frontend\widgets\Shop;

use core\readModels\Shop\ProductReadRepository;
use yii\base\Widget;

class RelatedProductsWidget extends Widget
{
    private $repository;
    public $title = 'СОПУТСТВУЮЩИЕ ТОВАРЫ';
    public $limit = 4;
    public $class = 'product-of-cat';
    public $productId;
    public $viewAll = null;

    public function __construct(ProductReadRepository $repository, array $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run()
    {
        if ($products = $this->repository->getRelatedProducts($this->limit, $this->productId)) {
            return $this->render('product-line', [
                'products' => $products,
                'title' => $this->title,
                'class' => $this->class,
                'viewAll' => $this->viewAll,
            ]);
        }
    }
}
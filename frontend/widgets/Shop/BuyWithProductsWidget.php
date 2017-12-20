<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 20.12.17
 * Time: 15:03
 */

namespace frontend\widgets\Shop;

use core\readModels\Shop\ProductReadRepository;
use yii\base\Widget;

class BuyWithProductsWidget extends Widget
{
    private $repository;
    public $title = 'C ЭТИМ ТОВАРОМ ПОКУПАЮТ';
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
        if ($products = $this->repository->getBuyWithProducts($this->limit, $this->productId)) {
            return $this->render('product-line', [
                'products' => $products,
                'title' => $this->title,
                'class' => $this->class,
                'viewAll' => $this->viewAll,
            ]);
        }
    }

}
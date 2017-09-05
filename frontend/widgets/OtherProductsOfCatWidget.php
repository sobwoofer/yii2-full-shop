<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 05.09.17
 * Time: 10:28
 */

namespace frontend\widgets;


use core\readModels\Shop\ProductReadRepository;
use yii\base\Widget;

class OtherProductsOfCatWidget extends Widget
{
    private $repository;
    public $title = 'ДРУГИЕ ТОВАРЫ КАТЕГОРИИ';
    public $limit;
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
        return $this->render('product-line', [
            'products' => $this->repository->getOfCategory($this->limit, $this->productId),
            'title' => $this->title,
            'class' => $this->class,
            'viewAll' => $this->viewAll,
        ]);
    }

}
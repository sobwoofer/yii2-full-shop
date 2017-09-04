<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 04.09.17
 * Time: 16:33
 */

namespace frontend\widgets;


use core\readModels\Shop\ProductReadRepository;
use yii\base\Widget;

class SaleProductsWidget extends Widget
{
    private $repository;
    public $title = 'РАСПРОДАЖИ';
    public $limit;
    public $class = 'sale';

    public function __construct(ProductReadRepository $repository, array $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run()
    {
        $this->render('product-line', [
            'products' => $this->repository->getSale($this->limit),
            'title' => $this->title,
            'class' => $this->class,
        ]);
    }

}
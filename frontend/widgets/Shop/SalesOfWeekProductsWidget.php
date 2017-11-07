<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 04.09.17
 * Time: 16:12
 */

namespace frontend\widgets\Shop;


use core\readModels\Shop\ProductReadRepository;
use yii\base\Widget;

class SalesOfWeekProductsWidget extends Widget
{
    private $repository;
    public $title = 'Скидки недели';
    public $limit = 4;
    public $class = 'sales-of-week';
    public $viewAll = 'sales-of-week-products';
    public $banner = false;

    public function __construct(ProductReadRepository $repository, array $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->render('product-banner-line', [
            'products' => $this->repository->getNew($this->limit),
            'title' => $this->title,
            'class' => $this->class,
            'viewAll' => $this->viewAll,
            'banner' => $this->banner,
        ]);
    }

}
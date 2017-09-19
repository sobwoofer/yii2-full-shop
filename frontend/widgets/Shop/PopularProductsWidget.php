<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 04.09.17
 * Time: 16:49
 */

namespace frontend\widgets\Shop;


use core\readModels\Shop\ProductReadRepository;
use yii\base\Widget;

class PopularProductsWidget extends Widget
{
    private $repository;
    public $title = 'ПОПУЛЯРНЫЕ';
    public $limit;
    public $class = 'popular';
    public $viewAll = 'popular-products';

    public function __construct(ProductReadRepository $repository, array $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->render('product-line', [
            'products' => $this->repository->getPopular($this->limit),
            'title' => $this->title,
            'class' => $this->class,
            'viewAll' => $this->viewAll,
        ]);
    }

}
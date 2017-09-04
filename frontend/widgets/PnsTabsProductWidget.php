<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 04.09.17
 * Time: 17:11
 */

namespace frontend\widgets;


use yii\base\Widget;
use core\readModels\Shop\ProductReadRepository;

class PnsTabsProductWidget extends Widget
{
    private $repository;
    public $popularTitle = 'ПОПУЛЯРНЫЕ';
    public $newTitle = 'НОВИНКИ';
    public $saleTitle = 'РАСПРОДАЖИ';
    public $limit;
    public $class = 'product-line__tabs';

    public function __construct(ProductReadRepository $repository, array $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->render('product-tabs', [
            'products' => $this->getProducts(),
            'title1' => $this->popularTitle,
            'title2' => $this->newTitle,
            'title3' => $this->saleTitle,
            'class' => $this->class,
        ]);
    }

    public function getProducts()
    {
        $data = [];
        $data['content1'] = $this->repository->getPopular($this->limit);
        $data['content2'] = $this->repository->getNew($this->limit);
        $data['content3'] = $this->repository->getSale($this->limit);

        return $data;
    }


}
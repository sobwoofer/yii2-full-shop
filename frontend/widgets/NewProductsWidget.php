<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 04.09.17
 * Time: 16:12
 */

namespace frontend\widgets;


use core\readModels\Shop\ProductReadRepository;
use yii\base\Widget;

class NewProductsWidget extends Widget
{
    private $repository;
    public $title = 'НОВИНКИ';
    public $limit;
    public $class = 'news';

    public function __construct(ProductReadRepository $repository, array $config = [])
    {
        parent::__construct($config);
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->render('product-line', [
            'products' => $this->repository->getNew($this->limit),
            'title' => $this->title,
            'class' => $this->class,
        ]);
    }

}
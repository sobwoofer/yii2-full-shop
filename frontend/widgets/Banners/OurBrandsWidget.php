<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.10.17
 * Time: 12:21
 */

namespace frontend\widgets\Banners;


use core\readModels\Shop\BrandReadRepository;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class OurBrandsWidget extends Widget
{
    private $repository;
    public $title = 'НАШИ БРЕНДЫ';
    public $limit = null;
    public $class = 'our_clients';

    public function __construct(BrandReadRepository $repository, array $config = [])
    {
        $this->repository = $repository;
        parent::__construct($config);
    }

    public function run(): string
    {
        return $this->render('banners-carousel', [
            'banners' => array_map(function($brand){
                return Html::a(Html::img($brand->getThumbFileUrl('image', 'home')), $brand->slug);
            }, $this->repository->getAll($this->limit)),
            'class' => $this->class,
            'title' => $this->title
        ]);
    }

}
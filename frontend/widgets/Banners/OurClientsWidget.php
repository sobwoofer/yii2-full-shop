<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.10.17
 * Time: 11:49
 */

namespace frontend\widgets\Banners;


use yii\base\Widget;

class OurClientsWidget extends Widget
{
    //TODO need create entity banner, input there images and description and assignment their of banners widgets.

    private $banners;
    public $title = 'НАШИ КЛИЕНТЫ';
    public $limit;
    public $class = 'our_clients';
//
//    public function __construct(BannersReadRepository $banners, $config = [])
//    {
//        parent::__construct($config);
//        $this->banners = $banners;
//    }

    public function run(): string
    {
        return $this->render('banners-carousel', [
//            'banners' => $this->repository->getPopular($this->banners),
            'class' => $this->class,
            'title' => $this->title
        ]);
    }

}
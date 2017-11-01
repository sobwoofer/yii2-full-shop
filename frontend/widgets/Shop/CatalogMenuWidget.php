<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 31.10.17
 * Time: 11:41
 */

namespace frontend\widgets\Shop;


use core\readModels\Shop\CategoryReadRepository;
use yii\base\Widget;
use core\readModels\Shop\views\CategoryView;
use yii\helpers\Html;
use core\entities\Shop\Category;

class CatalogMenuWidget extends Widget
{
    private $categories;
    public $active = null;

    public function __construct(CategoryReadRepository $categories, array $config = [])
    {
        parent::__construct($config);
        $this->categories = $categories;
    }

    public function run()
    {
        return $this->render('catalog-menu', ['categories' => $this->categories->getAllTree()]);
    }
}
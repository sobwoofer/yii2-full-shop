<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 01.09.17
 * Time: 9:16
 */


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category core\entities\Shop\Category */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$this->title = $category->getSeoTitle();

$this->registerMetaTag(['name' =>'description', 'content' => $category->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $category->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
foreach ($category->parents as $parent) {
    if (!$parent->isRoot()) {
        $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
    }
}
$this->params['breadcrumbs'][] = $category->name;
?>

<?= $this->render('_subcategories', [
    'category' => $category
]) ?>


<div class="container">
    <div class="row">
        <div class="catalog-page">
            <?=  $this->render('/shop/filter') ?>

            <?= $this->render('_list', [
                'dataProvider' => $dataProvider
            ]) ?>

        </div>
    </div>
</div>

<div class="clearfix"></div>


//= modules/product-line.html

<?= $this->render('/shop/seoblock', [
    'shortText' => $category->description
    ]) ?>




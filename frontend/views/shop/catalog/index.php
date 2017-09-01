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

$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_subcategories', [
    'category' => $category
]) ?>



<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>


    //= modules/product-line.html

    //= modules/seo-block.html


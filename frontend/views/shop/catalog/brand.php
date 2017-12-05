<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 04.09.17
 * Time: 13:14
 */


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $brand core\entities\Shop\Brand\Brand */

use yii\helpers\Html;

$this->title = $brand->getSeoTitle();

$this->registerMetaTag(['name' =>'description', 'content' => $brand->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $brand->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $brand->name;
?>

<h1><?= Html::encode($brand->name) ?></h1>

<hr />

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>



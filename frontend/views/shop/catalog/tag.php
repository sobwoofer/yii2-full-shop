<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 04.09.17
 * Time: 13:16
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $tag core\entities\Shop\Tag */

use yii\helpers\Html;

$this->title = 'Products with tag ' . $tag->name;

$this->params['breadcrumbs'][] = ['label' => 'Catalog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $tag->name;
?>

<h1>Products with tag &laquo;<?= Html::encode($tag->name) ?>&raquo;</h1>

<hr />

<?= $this->render('_list', [
    'dataProvider' => $dataProvider
]) ?>



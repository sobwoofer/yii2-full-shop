<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 19.09.17
 * Time: 13:56
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $category core\entities\Blog\Category */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = $category->getSeoTitle();

$this->registerMetaTag(['name' =>'description', 'content' => $category->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $category->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' => ['index']];
$this->params['breadcrumbs'][] = $category->name;

$this->params['active_category'] = $category;
?>

<div class="hidden-sm hidden-xs">
    <div class="bread_crumbs">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => '']
        ]) ?>
    </div>
</div>

<h2 class="main-title"><?= Html::encode($category->getHeadingTitle()) ?></h2>

<?= $this->render('_list', ['dataProvider' => $dataProvider]) ?>



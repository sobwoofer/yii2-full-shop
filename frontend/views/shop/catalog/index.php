<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 01.09.17
 * Time: 9:16
 */

/* @var $this yii\web\View */
/* @var $category core\entities\Shop\Category */

use romkaChev\yii2\swiper\Swiper;
use yii\helpers\Html;

$this->title = 'Catalog';
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="row clearfix">
        <div class="col-md-3 ">
        </div>
        <div class="col-md-9 ">
            <div class="row">
                <div class="col-sm-12 left-main-block">
                    <?= \frontend\widgets\content\SliderForBannersWidget::widget() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-9">

            <?= $this->render('_subcategories', [
                'category' => $category
            ]) ?>

        </div>
    </div>

    <hr>



<?= $this->render('/shop/seoblock', [
    'shortText' => $category->description
]) ?>











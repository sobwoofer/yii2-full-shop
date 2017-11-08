<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 31.08.17
 * Time: 16:34
 */

/* @var $this \yii\web\View */
/* @var $content string */

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="container">
    <?= $content ?>
</div>

<?= \frontend\widgets\Shop\ViewedProductsWidget::widget(['limit' => 6]) ?>

<?= \frontend\widgets\Shop\SalesOfWeekProductsWidget::widget(['limit' => 6, 'banner' => [
    'link' => '/',
    'image' => '/images/system/ba2.png'
]]) ?>

<?php $this->endContent() ?>

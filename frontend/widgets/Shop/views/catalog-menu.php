<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 31.10.17
 * Time: 11:43
 */
/** @var $categories \core\readModels\Shop\views\CatalogMenuView[] */

use yii\helpers\Html;
?>


<div class="catalog active">
    <button class="catalog-btn"><i>Каталог</i> <span></span></button>
    <ul class="menu">
        <?php foreach ($categories as $category): ?>
            <li class="menu__item">
                <?= Html::a($category->category->name,
                    ['/shop/catalog/category', 'id' => $category->category->id],
                    ['class' => 'menu__link']) ?>
                <?php if ($category->_children): ?>
                    <ul class="sub_menu">
                        <div class="row">
                            <?php foreach ($category->_children as $child): ?>
                                <div class="col-md-4">
                                    <?php if (!$child->_children): ?>
                                        <?= Html::a($child->category->name,
                                            ['/shop/catalog/category', 'id' => $child->category->id],
                                            ['class' => 'sub_menu__title']) ?>
                                    <?php else: ?>
                                        <li class="menu__item">
                                            <?= Html::a($child->category->name,
                                                ['/shop/catalog/category', 'id' => $child->category->id],
                                                ['class' => 'sub_menu__link']) ?>
                                            <ul class="menu menu_flat">
                                                <?php foreach ($child->_children as $subChild): ?>
                                                    <li class="menu__item">
                                                        <?= Html::a($subChild->category->name,
                                                            ['/shop/catalog/category', 'id' => $subChild->category->id],
                                                            ['class' => 'menu__link menu__link_flat']) ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

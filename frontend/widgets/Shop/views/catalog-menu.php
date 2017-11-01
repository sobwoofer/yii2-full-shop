<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 31.10.17
 * Time: 11:43
 */
/** @var $categories \core\readModels\Shop\views\CatalogMenuView[]*/
?>



<div class="catalog active">
    <button class="catalog-btn"><i>Каталог</i> <span></span></button>
    <ul class="menu">
        <?php foreach ($categories as $category): ?>
            <li class="menu__item">
            <a class="menu__link" href="#"> <?= $category->category->name ?></a>
                <?php if ($category->_children): ?>
                    <ul class="sub_menu">
                        <div class="row">
                            <?php foreach ($category->_children as $child): ?>
                                <div class="col-md-4">
                                    <?php if (!$child->_children): ?>
                                        <a class="sub_menu__title" href="#"><?= $child->category->name ?></a>
                                    <?php else: ?>
                                        <li class="menu__item"><a class="sub_menu__link" href="#"><?= $child->category->name ?></a>
                                            <ul class="menu menu_flat">
                                                <?php foreach ($child->_children as $subChild): ?>
                                                    <li class="menu__item">
                                                        <a class="menu__link menu__link_flat" href="#"><?= $subChild->category->name ?></a>
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

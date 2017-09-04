<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 01.09.17
 * Time: 15:32
 */

/* @var $category core\entities\Shop\Category */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php if ($category->children): ?>

    <div class="row">
        <div class="col-md-3 col-lg-2"></div>
        <div class="col-md-9 col-lg-10">
            <div class="categories">
                <?php foreach ($category->children as $child): ?>
                    <div class="col-sm-4 col-lg-2">
                        <div class="categories-item">
                            <div class="categories-item-img">
                                <a href="<?= Html::encode(Url::to(['category', 'id' => $child->id])) ?>">
                                    <img src="images/paper.png" alt="">
                                </a>
                            </div>
                            <span><?= Html::encode($child->name) ?></span>
                            <ul>
                                <li><a href="#">все товары</a></li>
                            </ul>
                            <span>Конверты</span>
                            <ul>
                                <li><a href="#">все товары</a></li>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <hr>

<?php endif; ?>

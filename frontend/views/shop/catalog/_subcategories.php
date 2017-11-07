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
use yii\widgets\Breadcrumbs;

?>

<?php if ($category->children): ?>


            <div class="categories">
                <?php foreach ($category->children as $child): ?>
                    <div class="col-sm-4 col-xs-6">
                        <div class="categories-item">
                            <div class="categories-item-img">
                                <a href="<?= Html::encode(Url::to(['category', 'id' => $child->id])) ?>">
                                    <?= Html::img($child->getThumbFileUrl('image', 'catalog')) ?>
                                </a>
                            </div>
                            <span>
                                <a href="<?= Html::encode(Url::to(['category', 'id' => $child->id])) ?>">
                                    <?= Html::encode($child->name) ?>
                                </a>
                            </span>
                            <?php if ($category->children): ?>
                                <ul>
                                <?php foreach ($child->children as $subChild): ?>
                                    <li><a href="<?= Html::encode(Url::to(['category', 'id' => $subChild->id])) ?>">
                                            <?= Html::encode($subChild->name) ?></a>
                                    </li>
                                <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>




<?php endif; ?>

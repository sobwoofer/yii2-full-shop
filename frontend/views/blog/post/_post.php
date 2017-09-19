<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 19.09.17
 * Time: 14:12
 */

/* @var $this yii\web\View */
/* @var $model core\entities\Blog\Post\Post */

use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::to(['post', 'id' =>$model->id]);
?>

<div class="news-item">
    <div class="row">

        <div class="col-sm-4 col-lg-3">
            <div class="responsive-img">
                <a href="<?= Html::encode($url) ?>">
                    <?php if ($model->photo): ?>
                        <img src="<?= Html::encode($model->getThumbFileUrl('photo', 'blog_list')) ?>" alt="" class="img-responsive" />
                    <?php endif; ?>
                </a>
            </div>
        </div>

        <div class="col-sm-8 col-lg-9">
            <p class="news_item-title"><?= Html::encode($model->title) ?> <span class="news-date">28.04.2017</span></p>
            <p><?= Yii::$app->formatter->asNtext($model->description) ?></p>
            <a href="<?= Html::encode($url) ?>" class="read_more">подробнее <span></span></a>
        </div>
    </div>
</div>

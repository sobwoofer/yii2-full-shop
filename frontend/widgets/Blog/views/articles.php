<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.10.17
 * Time: 16:48
 */
/** @var $title string */
/** @var $url string */
/** @var $posts \core\entities\Blog\Post\Post[] */
/** @var $categorySlug string */


use yii\helpers\Url;

?>

<div class="news">
    <div class="container">
        <div class="news_title_block">
            <p><?= $title ?></p>
            <a href="<?= Url::to(['/blog/' . $categorySlug]) ?>" class="read_more">смотреть все<span></span></a>
        </div>
        <div class="row">
            <?php foreach ($posts as $post): ?>
                <div class="col-md-4 col-lg-3">
                    <div class="news__item">
                        <div class="news__item__img">
                            <a href="#"><img src="<?= $post->getThumbFileUrl('photo','home') ?>" alt=""></a>
                        </div>

                        <a href="#" class="news__item__title"><?= $post->title ?></a>
                        <p><?= $post->description ?></p>
                        <a href="<?= Url::to(['/blog/' . $post->id]) ?>" class="read_more"> читать дальше. <span></span></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 20.09.17
 * Time: 10:38
 */

/* @var $firstPosts \core\entities\Blog\Post\Post[] */
/* @var $secondPosts \core\entities\Blog\Post\Post[] */
/* @var $firstCategory \core\entities\Blog\Category */
/* @var $secondCategory \core\entities\Blog\Category */

use yii\helpers\Url;
?>

<div class="promotions_and_news">
    <div class="container">
        <div class="row">
            <div class="col-md-6 promotions_and_news__block__wrp">
                <a href="<?= Url::to(['/blog/' . $firstCategory->slug]) ?>" class="read_more">
                    смотреть все <span></span></a>
                <div class="col-md-7 ">

                    <div class="promotions_and_news__block">
                        <p class="promotions_and_news__block__title">
                            <?= $firstCategory->name ?>
                        </p>
                        <?php foreach($firstPosts as $post): ?>

                            <?php $url = Url::to(['/blog/post/post', 'id' =>$post->id]); ?>
                            <a href="<?= $url ?>">
                                <p><?= Yii::$app->formatter->asDatetime($post->created_at); ?></p>

                                <p><?= $post->title ?></p>
                            </a>
                            <hr>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="hidden visible-sm visible-xs">
                <br>
            </div>
            <div class="col-md-6 promotions_and_news__block__wrp">
                <a href="<?= Url::to(['/blog/' . $secondCategory->slug]) ?>" class="read_more">
                    смотреть все <span></span></a>
                <div class="col-md-7 ">

                    <div class="promotions_and_news__block">
                        <p class="promotions_and_news__block__title"><?= $secondCategory->name ?></p>
                        <?php foreach($secondPosts as $post): ?>
                            <?php $url = Url::to(['/blog/post/post', 'id' =>$post->id]); ?>
                            <a href="<?= $url ?>">
                                <p><?= Yii::$app->formatter->asDatetime($post->created_at); ?></p>
                                <p><?= $post->title ?></p>
                            </a>
                            <hr>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
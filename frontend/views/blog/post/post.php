<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 19.09.17
 * Time: 13:54
 */

/* @var $this yii\web\View */
/* @var $post core\entities\Blog\Post\Post */

use yii\helpers\Html;

$this->title = $post->getSeoTitle();

$this->registerMetaTag(['name' =>'description', 'content' => $post->meta->description]);
$this->registerMetaTag(['name' =>'keywords', 'content' => $post->meta->keywords]);

$this->params['breadcrumbs'][] = ['label' => 'Blog', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $post->category->name, 'url' => ['category', 'slug' => $post->category->slug]];
$this->params['breadcrumbs'][] = $post->title;

$this->params['active_category'] = $post->category;

$tagLinks = [];
foreach ($post->tags as $tag) {
    $tagLinks[] = Html::a(Html::encode($tag->name), ['tag', 'slug' => $tag->slug]);
}
?>

<h1 class="article-title"><?= Html::encode($post->title) ?> - <?= Yii::$app->formatter->asDatetime($post->created_at); ?></h1>
<div class="responsive-img img">
    <?php if ($post->photo): ?>
        <p><img src="<?= Html::encode($post->getThumbFileUrl('photo', 'origin')) ?>" alt="" class="img-responsive" /></p>
    <?php endif; ?>
</div>
<p><?= Yii::$app->formatter->asNtext($post->content) ?></p>

<p><?= Yii::$app->formatter->asNtext($post->content) ?></p>

<p>Tags: <?= implode(', ', $tagLinks) ?></p>
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
<?php

?>
<div class="article-page">
    <h1 class="article-title"><?= Html::encode($post->title) ?></h1>
    <div class="responsive-img img full-img ">
        <?php if ($post->photo): ?>
            <p><img src="<?= Html::encode($post->getThumbFileUrl('photo', 'origin')) ?>" alt="" class="img-responsive" /></p>
        <?php endif; ?>
    </div>

    <?= Yii::$app->formatter->asHtml($post->content, [
        'Attr.AllowedRel' => array('nofollow'),
        'HTML.SafeObject' => true,
        'Output.FlashCompat' => true,
        'HTML.SafeIframe' => true,
        'URI.SafeIframeRegexp'=>'%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
    ]) ?>
</div>

<?php
//\frontend\widgets\Blog\CommentsWidget::widget([
//    'post' => $post,
//])
?>

<p> <?= $tagLinks ? 'Tags:' . implode(', ', $tagLinks) : '' ?></p>
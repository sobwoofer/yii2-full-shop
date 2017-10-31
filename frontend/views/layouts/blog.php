<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 19.09.17
 * Time: 13:59
 */

/* @var $this \yii\web\View */
/* @var $content string */

?>
<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<div class="container">
    <div class="news-page">
<!--        TODO this will be xs and sm breadcrumbs -->
        <div class="row">
            <div class="col-md-3">
                <?= \frontend\widgets\Blog\CategoriesWidget::widget() ?>
                <div class="responsive-img">
                    <img src="images/b.png" alt="">
                </div>
            </div>
            <div class="col-md-9">
                <?= $content ?>
            </div>
        </div>
    </div>

</div>



<?php $this->endContent() ?>

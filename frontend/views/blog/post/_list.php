<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 19.09.17
 * Time: 14:53
 */
/* @var $dataProvider yii\data\DataProviderInterface*/
use yii\widgets\LinkPager;
?>

<ul class="news-list">
    <?php foreach ($dataProvider->getModels() as $post): ?>
    <li>
        <?= $this->render('_post', ['model' => $post]) ?>
    </li>
    <?php endforeach; ?>
</ul>


<?= LinkPager::widget([
    'pagination' => $dataProvider->getPagination(),
]) ?>

<div class="col-sm-6 text-right">Показано <?= $dataProvider->getCount() ?> из <?= $dataProvider->getTotalCount() ?></div>
<div class="load-more">
    <img src="images/system/load-more.png" alt="">
    <p>Загрузить еще <br>3 новости</p>
</div>
<div class="paginator">
    <ul>
        <li><a href="#">Пред.</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">...</a></li>
        <li><a href="#">8</a></li>
        <li><a href="#">След.</a></li>
    </ul>
</div>


<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 07.09.17
 * Time: 18:16
 */

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */

use core\entities\Shop\Product\Product;
use core\helpers\PriceHelper;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = 'Wish List';
$this->params['breadcrumbs'][] = ['label' => 'Cabinet', 'url' => ['cabinet/index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="content">
    <div class="hidden-sm hidden-xs">
        <div class="bread_crumbs">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => ['class' => '']
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6"><h2 class="catalog-title"><b><?= Html::encode($this->title) ?></b></h2></div>
        <div class="col-sm-6">

            <div class="display-wrp pull-right">
                <!--<p>Отображение</p>-->
                <a href="/catalog.html" class="grid"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                <a href="/catalog_list.html" class="list"><i class="fa fa-list" aria-hidden="true"></i></a>
            </div>
            <div class="select">
                <select class="pull-right" onchange="location = this.value;">
                    <?php
                    $values = [
                        '' => 'Default',
                        'name' => 'Name (A - Z)',
                        '-name' => 'Name (Z - A)',
                        'price' => 'Price (Low &gt; High)',
                        '-price' => 'Price (High &gt; Low)',
                        '-rating' => 'Rating (Highest)',
                        'rating' => 'Rating (Lowest)',
                    ];
                    $current = Yii::$app->request->get('sort');
                    ?>
                    <?php foreach ($values as $value => $label): ?>
                        <option value="<?= Html::encode(Url::current(['sort' => $value ?: null])) ?>" <?php if ($current == $value): ?>selected="selected"<?php endif; ?>><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php //<select id="input-limit" class="form-control" onchange="location = this.value;"> ?>
            <?php
            //$values = [15, 25, 50, 75, 100];
            //$current = $dataProvider->getPagination()->getPageSize();
            ?>
            <?php //foreach ($values as $value): ?>
            <?php //<option value="?><?php //echo Html::encode(Url::current(['per-page' => $value])) ?><?php //" ?><?php //if ($current == $value): ?><?php //selected="selected"?><?php //endif; ?><?php //>?><?php //echo $value ?><?php //</option>?>
                            <?php// endforeach; ?>
                        <?php //</select> ?>

        </div>
    </div>

    <div class="product_content">
        <?php foreach ($dataProvider->getModels() as $product): ?>
        <div class="col-sm-4">
            <?=  $this->render('/shop/catalog/_product',[
            'product' => $product
            ]) ?>
        </div>
        <?php endforeach; ?>

            <div class="load-more">
                <img src="http://static.yii-shop.dev/dev/load-more.png" alt="">
                <p>Загрузить еще <br>15 товаров</p>
            </div>

        <?= LinkPager::widget([
        'pagination' => $dataProvider->getPagination(),
        ]) ?>
        <div class="col-sm-6 text-right">Показано <?= $dataProvider->getCount() ?> из <?= $dataProvider->getTotalCount() ?></div>
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
    </div>
</div>



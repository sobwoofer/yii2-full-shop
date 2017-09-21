<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.09.17
 * Time: 10:37
 */

/* @var $this yii\web\View */
/* @var $page core\entities\Page */
/* @var $model core\forms\manage\PageForm */

$this->title = 'Update Page: ' . $page->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $page->title, 'url' => ['view', 'id' => $page->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="page-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

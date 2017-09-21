<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.09.17
 * Time: 10:36
 */

/* @var $this yii\web\View */
/* @var $model core\forms\manage\PageForm */

$this->title = 'Create Page';
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

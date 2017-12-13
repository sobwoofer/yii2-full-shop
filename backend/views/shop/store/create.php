<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 23.08.17
 * Time: 12:19
 */

/* @var $this yii\web\View */
/* @var $model core\forms\manage\Shop\StoreForm */

$this->title = 'Create Store';
$this->params['breadcrumbs'][] = ['label' => 'Stores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
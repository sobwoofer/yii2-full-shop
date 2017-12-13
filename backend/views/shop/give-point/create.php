<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 23.08.17
 * Time: 12:19
 */

/* @var $this yii\web\View */
/* @var $model core\forms\manage\Shop\GivePointForm */

$this->title = 'Create Give point';
$this->params['breadcrumbs'][] = ['label' => 'Give point', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
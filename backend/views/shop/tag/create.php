<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 28.08.17
 * Time: 12:13
 */

/* @var $this yii\web\View */
/* @var $model core\forms\manage\Shop\TagForm */

$this->title = 'Create Tag';
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

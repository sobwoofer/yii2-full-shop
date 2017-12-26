<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 13:01
 */

/* @var $this yii\web\View */
/* @var $model core\forms\manage\Shop\Modification\ModificationForm */

$this->title = 'Create Modification';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modification-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

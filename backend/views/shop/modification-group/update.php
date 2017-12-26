<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 13:02
 */

/* @var $this yii\web\View */
/* @var $modificationGroup core\entities\Shop\Modification\ModificationGroup */
/* @var $model core\forms\manage\Shop\Modification\ModificationGroupForm */

$this->title = 'Update Modification Group: ' . $modificationGroup->name;
$this->params['breadcrumbs'][] = ['label' => 'Modifications', 'url' => ['shop/modification-group/index']];
$this->params['breadcrumbs'][] = ['label' => $modificationGroup->name, 'url' => ['shop/modification-group/view', 'id' => $modificationGroup->id]];
$this->params['breadcrumbs'][] = $modificationGroup->name;
?>
<div class="modification-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 28.08.17
 * Time: 16:28
 */

/* @var $this yii\web\View */
/* @var $model core\forms\manage\Shop\CharacteristicForm */

$this->title = 'Create Characteristic';
$this->params['breadcrumbs'][] = ['label' => 'Characteristics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="characteristic-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

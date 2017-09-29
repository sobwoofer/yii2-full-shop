<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 29.09.17
 * Time: 12:03
 */

return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/test-local.php'),
    require(__DIR__ . '/main.php'),
    require(__DIR__ . '/main-local.php'),
    require(__DIR__ . '/test.php'),
    [
    ]
);

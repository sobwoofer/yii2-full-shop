<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 10.10.17
 * Time: 14:10
 */

namespace console\controllers;


use Elasticsearch\Endpoints\Cat\Aliases;
use yii\console\Controller;
use Yii;

class DocController extends Controller
{
    public function actionBuild()
    {
        $swagger = Yii::getAlias('@vendor/bin/swagger');
        $source = Yii::getAlias('@api/controllers');
        $target = Yii::getAlias('@api/web/docs/swagger.json');

        passthru('"' . PHP_BINARY . '"' . " \"{$swagger}\" \"{$source}\" --output \"{$target}\"");
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 24.10.17
 * Time: 14:40
 */

namespace console\controllers;

use yii\console\Controller;
use Yii;

class TestController extends Controller
{
    public function actionAddQueue()
    {
        Yii::$app->queue->push(new TestQueueJob([
            'name' => 'vasya pupkin'
        ]));
    }

    public function actionWriteText($text)
    {
        $this->stdout('Text: ' . $text . PHP_EOL);
    }


}
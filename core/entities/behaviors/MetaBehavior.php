<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 14.08.17
 * Time: 12:26
 */

namespace core\entities\behaviors;


use core\entities\Meta;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

class MetaBehavior extends Behavior
{
    /**
     * @var string
     * property name of meta
     */
    public $attribute = 'meta';

    /**
     * @var string
     * column name of tables DB
     */
    public $jsonAttribute = 'meta_json';

    /**
     * @return array
     * named call methods after worked something event
     */
    public function events(): array
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'onAfterFind',
            ActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave',
        ];
    }

    /**
     * @param Event $event
     * parse json string to php object after select from DB
     */
    public function onAfterFind(Event $event): void
    {
        $model = $event->sender;

        $meta = Json::decode($model->getAttribute($this->jsonAttribute));

        $model->{$this->attribute} = new Meta(
            ArrayHelper::getValue($meta, 'title'),
            ArrayHelper::getValue($meta, 'description'),
            ArrayHelper::getValue($meta, 'keywords')
        );


    }

    /**
     * @param Event $event
     * generate json string from php object before insert or update it.
     */
    public function onBeforeSave(Event $event): void
    {

        $model = $event->sender;

        $model->setAttribute('meta_json', Json::encode([
            'title' => $model->{$this->attribute}->title,
            'description' => $model->{$this->attribute}->description,
            'keywords' => $model->{$this->attribute}->keywords,
        ]));
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.01.18
 * Time: 15:12
 */

namespace core\entities\behaviors;


use core\entities\Shop\Order\ModificationWrapper;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\base\Event;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

class OrderItemBehavior extends Behavior
{
    public $attribute = 'modifications';
    public $jsonAttribute = 'modifications_json';

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
        $modifications = Json::decode($model->getAttribute($this->jsonAttribute));
        if ($modifications) {
            foreach ($modifications as $modification) {
                $model->{$this->attribute}[] = new ModificationWrapper(
                    ArrayHelper::getValue($modification, 'id'),
                    ArrayHelper::getValue($modification, 'code'),
                    ArrayHelper::getValue($modification, 'price'),
                    ArrayHelper::getValue($modification, 'cost'),
                    ArrayHelper::getValue($modification, 'quantity'),
                    ArrayHelper::getValue($modification, 'name')
                );
            }
        }

    }

    /**
     * @param Event $event
     * generate json string from php object before insert or update it.
     */
    public function onBeforeSave(Event $event): void
    {

        $model = $event->sender;

        $model->setAttribute($this->jsonAttribute, Json::encode($model->{$this->attribute}));
    }

}
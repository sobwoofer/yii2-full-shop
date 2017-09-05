<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 05.09.17
 * Time: 12:30
 */

namespace core\forms\Shop;


use yii\base\Model;

class ReviewForm extends Model
{
    public $vote;
    public $text;

    public function  rules()
    {
        return [
            [['vote', 'text'], 'required'],
            [['vote'], 'in', 'range' => array_keys($this->votesList())],
            ['text', 'string'],
        ];
    }

    public function votesList(): array
    {
        return [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
            5 => 5,
        ];
    }

}
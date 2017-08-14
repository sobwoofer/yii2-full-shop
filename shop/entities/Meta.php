<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 14.08.17
 * Time: 11:15
 */

namespace shop\entities;


class Meta
{
    public $title;
    public $description;
    public $keywords;

    public function __construct($title, $description, $keywords)
    {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
    }
}
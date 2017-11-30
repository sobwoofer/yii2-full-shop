<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 14.08.17
 * Time: 11:15
 */

namespace core\entities;

/**
 * Class Meta
 * @package core\entities
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $title_ua
 * @property string $description_ua
 * @property string $keywords_ua
 */
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
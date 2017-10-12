<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.10.17
 * Time: 17:05
 */

namespace core\services\sitemap;

class IndexItem
{
    public $location;
    public $lastModified;

    public function __construct($location, $lastModified = null)
    {
        $this->location = $location;
        $this->lastModified = $lastModified;
    }
}
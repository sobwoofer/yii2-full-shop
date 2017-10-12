<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 12.10.17
 * Time: 17:05
 */

namespace core\services\sitemap;

class MapItem
{
    const ALWAYS = 'always';
    const HOURLY = 'hourly';
    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const YEARLY = 'yearly';
    const NEVER = 'never';

    public $location;
    public $lastModified;
    public $changeFrequency;
    public $priority;

    public function __construct($location, $lastModified = null, $changeFrequency = null, $priority = null)
    {
        $this->location = $location;
        $this->lastModified = $lastModified;
        $this->changeFrequency = $changeFrequency;
        $this->priority = $priority;
    }
}
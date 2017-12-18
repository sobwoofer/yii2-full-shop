<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 18.12.17
 * Time: 13:14
 */

namespace core\services\location\storage;


interface StorageInterface
{
    /**
     * @return array
     * @param  $param
     */
    public function load(string $param): string;


    /**
     * @param mixed $value
     * @param string $key
     */
    public function save(string $key, $value): void;

}
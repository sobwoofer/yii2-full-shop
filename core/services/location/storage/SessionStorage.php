<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 18.12.17
 * Time: 13:11
 */

namespace core\services\location\storage;

use yii\web\Session;

class SessionStorage implements StorageInterface
{
    private $session;
    private $key;

    public function __construct($key, Session $session)
    {
        $this->session = $session;
        $this->key = $key;
    }

    /**
     * @param string $param
     * @return array
     */
    public function load(string $param): string
    {
        $result = $this->session->get($this->key);

        return $result[$param];
    }

    /**
     * @param string $param
     * @param mixed $value
     */
    public function save(string $param, $value): void
    {
       $this->session->set($this->key, [$param => $value]);

    }

}
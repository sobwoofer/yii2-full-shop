<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 08.09.17
 * Time: 14:53
 */

namespace core\cart\storage;

use Yii;
use yii\web\Session;

class SessionStorage implements StorageInterface
{
    private $key;
    private $session;

    public function __construct($key, Session $session)
    {
        $this->key = $key;
        $this->session = $session;
    }

    public function load(): array
    {
        return $this->session->get($this->key, []);
    }

    public function save(array $items): void
    {
        $this->session->set($this->key, $items);
    }
}
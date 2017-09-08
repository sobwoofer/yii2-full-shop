<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 08.09.17
 * Time: 14:55
 */

namespace core\cart\storage;

use core\cart\CartItem;

interface StorageInterface
{
    /**
     * @return CartItem[]
     */
    public function load(): array;

    /**
     * @param CartItem[] $items
     */
    public function save(array $items): void;

}
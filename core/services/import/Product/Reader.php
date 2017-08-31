<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 16:15
 */

namespace core\services\import\Product;

use core\services\import\Product\Row;
//TODO import watch on four lesson elisDN 4:30
//TODO нужно сделать так чтобы файл Если это синхронизация с 1с
//TODO ложился на сервер и только потом по крону запускался импорт

/**
 * Class Reader
 * @package core\services\import\Product
 * Example first version import
 */
class Reader
{

    public function readCsv($file): iterable
    {
        $result = [];
        $f = fopen($file->tmpName, 'r');

        while ($fields = fgetcsv($f)) {
            $row = new Row();
            $row->name = $fields[0];
            $row->price = $fields[1];
            $row->description = $fields[2];
            $row->quantity = $fields[3];
            //...
            yield $row;
        }
        fclose($f);
//        return null;
    }

}
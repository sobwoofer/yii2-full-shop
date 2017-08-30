<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 16:15
 */

namespace core\services\import\Product;

use core\services\import\Product\Row;
//TODO watch on four lesson elisDN 4:30
/**
 * Class Reader
 * @package core\services\import\Product
 * Example first version import
 */
class Reader
{
    /**
     * @param $file
     * @return Row[];
     */
    public function readCsv($file)
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
            $result[] = $row;
        }
        return $result;
    }

}
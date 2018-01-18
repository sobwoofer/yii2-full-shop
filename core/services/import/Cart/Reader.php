<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 17.01.18
 * Time: 15:35
 */

namespace core\services\import\Cart;


use yii\web\UploadedFile;

class Reader
{

    public function getRows($file)
    {

        return $this->readCsv($file);

    }

//    public function readCsv(UploadedFile $file): iterable

    /**
     * @param UploadedFile $file
     * @return Row[] $result;
     */
    public function readCsv(UploadedFile $file): array
    {
        $result = [];
        $f = fopen($file->tempName, 'r');
        $counter = 0;

        while ($fields = fgetcsv($f)) {

            $counter++;
            if ($counter == 1) {
                continue;
            }

            $row = new Row();
            $row->code = $fields[0];
            $row->quantity = $fields[1];

//            yield $row;
            $result[] = $row;


        }
        fclose($f);

//        return null;
        return $result;
    }

}
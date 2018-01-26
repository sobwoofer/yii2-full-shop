<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 17.01.18
 * Time: 15:35
 */

namespace core\services\import\Cart;


use moonland\phpexcel\Excel;
use yii\web\UploadedFile;

class Reader
{

    public function getRows(UploadedFile $file)
    {
        switch ($file->type){
            case 'text/csv':
                $result = $this->readCsv($file);
                break;
            case 'application/vnd.ms-excel':
                $result = $this->readXls($file);
                break;
            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                $result = $this->readXls($file);
                break;
            default: $result = null;
        }

        return $result;

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

    public function readXls(UploadedFile $file)
    {
        $result = [];
        $fields = Excel::import($file->tempName);
        if (!is_array($result)) {
            return null;
        }
        foreach ($fields as $field) {
            $row = new Row();
            $row->code = array_shift($field);
            $row->quantity = array_shift($field);
            $result[] = $row;
        }
        return $result;
    }

}
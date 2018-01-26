<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 17.01.18
 * Time: 15:00
 */

namespace core\forms\Shop\Cart;


use yii\base\Model;
use yii\web\UploadedFile;

class FileAddToCartForm extends Model
{
    public $file;
    public $uploadedFile;

    public function rules()
    {
        return [
            ['file', 'file', 'extensions' => 'xls, xlsx, csv']
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {

            $this->uploadedFile = UploadedFile::getInstance($this, 'file');
            return true;
        }
        return false;
    }

}
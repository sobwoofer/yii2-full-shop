<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 08.12.17
 * Time: 11:38
 */

namespace core\forms\manage\Shop\Product;

use yii\base\Model;
use yii\web\UploadedFile;

class Photos360Form extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $files;

    public function rules()
    {
        return [
            ['files', 'each', 'rule' => ['image']],
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->files = UploadedFile::getInstances($this, 'files');
            return true;
        }
        return false;
    }

}
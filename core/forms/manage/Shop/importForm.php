<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 30.08.17
 * Time: 16:55
 */

namespace core\forms\manage\Shop;


use yii\base\Model;
use yii\web\UploadedFile;
//TODO import
class importForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $files;

    public function rules()
    {
        return [
            ['files'],
            ['extension', ['xls', 'xlsx', 'xml', 'csv']]
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->files = UploadedFile::getInstance($this, 'file');
            return true;
        }
        return false;
    }

}
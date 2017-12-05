<?php

namespace core\forms\manage\Shop;

use core\entities\Shop\Brand\Brand;
use core\forms\CompositeForm;
use core\forms\manage\MetaForm;
use core\helpers\LangsHelper;
use core\validators\SlugValidator;
use yii\web\UploadedFile;

/**
 * @property MetaForm $meta;
 * @property string $name
 * @property string $description
 * @property string $name_ua
 * @property string $description_ua
 * @property MetaForm $meta_ua;
 * @property string $slug
 */
class BrandForm extends CompositeForm
{
    public $name;
    public $description;
    public $image;
    public $slug;
    private $_brand;

    public function __construct(Brand $brand = null, $config = [])
    {
        if ($brand) {
            foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
                $this->{'name' . $suffix} = $brand->{'name' . $suffix};
                $this->{'description' . $suffix} = $brand->{'description' . $suffix};
                $this->{'meta' . $suffix} = new MetaForm($brand->{'meta' . $suffix});
            }

            $this->slug = $brand->slug;
            $this->_brand = $brand;
        } else {
            foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
                $this->{'meta' . $suffix} = new MetaForm();
            }

        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [LangsHelper::getNamesWithSuffix(['name']), 'required'],
            [LangsHelper::getNamesWithSuffix(['name']), 'string', 'max' => 255],
            [LangsHelper::getNamesWithSuffix(['description']), 'string'],
            ['slug', 'string', 'max' => 255],
            [['image'], 'image'],
            ['slug', SlugValidator::class],
            ['slug', 'unique', 'targetClass' => Brand::class, 'filter' => $this->_brand ? ['<>', 'id', $this->_brand->id] : null]
        ];
    }

    public function internalForms(): array
    {
        return [LangsHelper::getNamesWithSuffix(['meta'])];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->image = UploadedFile::getInstance($this, 'image');
            return true;
        }
        return false;
    }
}
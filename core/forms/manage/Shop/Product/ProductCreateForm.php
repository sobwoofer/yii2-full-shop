<?php

namespace core\forms\manage\Shop\Product;

use core\entities\Shop\Brand\Brand;
use core\entities\Shop\Characteristic\Characteristic;
use core\entities\Shop\Product\Product;
use core\forms\CompositeForm;
use core\forms\manage\MetaForm;
use yii\helpers\ArrayHelper;
use core\helpers\LangsHelper;
use yii\web\UploadedFile;

/**
 * @property PriceForm $price
 * @property QuantityForm $quantity
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property PhotosForm $photos
 * @property TagsForm $tags
 * @property ValueForm[] $values
 * @property string $code
 * @property integer $weight
 * @property string $caseCode
 * @property string $video
 * @property string $guide
 * @property UploadedFile $guideFile
 * @property integer $qtyInPack
 * Общая композитная форма для создания и редактирования товара включает в себя мелкие формы
 */
class ProductCreateForm extends CompositeForm
{
    public $brandId;
    public $code;
    public $name;
    public $description;
    public $weight;

    public $caseCode;
    public $video;
    public $guide;
    public $guideFile;
    public $qtyInPack;

    public function __construct($config = [])
    {
        $this->price = new PriceForm();
        $this->quantity = new QuantityForm();
        $this->meta = new MetaForm();
        $this->categories = new CategoriesForm();
        $this->photos = new PhotosForm();
        $this->tags = new TagsForm();
        //в values попадает отсортированный массив из форм ValueForm уже заполненных каждая своим значениям
        $this->values = array_map(function (Characteristic $characteristic) {
            return new ValueForm($characteristic);
        }, Characteristic::find()->orderBy('sort')->all());

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $this->{'meta' . $suffix} = new MetaForm();
        }


        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [LangsHelper::getNamesWithSuffix(['name']), 'required'],
            [['brandId', 'code'], 'required'],
            [LangsHelper::getNamesWithSuffix(['name']), 'string', 'max' => 255],
            [['code', 'caseCode', 'video'], 'string', 'max' => 255],
            [['brandId', 'weight'], 'integer'],
            [['code', 'caseCode' => 'case_code'], 'unique', 'targetClass' => Product::class],
            [LangsHelper::getNamesWithSuffix(['description', 'title']), 'string'],
            [['weight', 'qtyInPack'], 'integer', 'min' => 0],
            ['guideFile', 'file', 'extensions' => 'pdf, doc, docx, txt, xls, xlsx, csv, zip, rar']
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->guideFile = UploadedFile::getInstance($this, 'guideFile');
            return true;
        }
        return false;
    }

    public function brandsList(): array
    {
        return ArrayHelper::map(Brand::find()->joinWith('translation')->orderBy('name')->asArray()->all(), 'id', 'translation.name');
    }

    protected function internalForms(): array
    {
        return [LangsHelper::getNamesWithSuffix(['meta']), 'price', 'quantity', 'photos', 'categories', 'tags', 'values'];
    }
}
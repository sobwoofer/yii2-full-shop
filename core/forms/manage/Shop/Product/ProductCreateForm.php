<?php

namespace core\forms\manage\Shop\Product;

use core\entities\Shop\Brand\Brand;
use core\entities\Shop\Characteristic\Characteristic;
use core\entities\Shop\Product\Product;
use core\forms\CompositeForm;
use core\forms\manage\MetaForm;
use yii\helpers\ArrayHelper;
use core\helpers\LangsHelper;

/**
 * @property PriceForm $price
 * @property QuantityForm $quantity
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property PhotosForm $photos
 * @property TagsForm $tags
 * @property ValueForm[] $values
 * Общая композитная форма для создания и редактирования товара включает в себя мелкие формы
 */
class ProductCreateForm extends CompositeForm
{
    public $brandId;
    public $code;
    public $name;
    public $description;
    public $weight;

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
            [['brandId', 'code', 'weight'], 'required'],
            [LangsHelper::getNamesWithSuffix(['name']), 'string', 'max' => 255],
            ['code', 'string', 'max' => 255],
            [['brandId'], 'integer'],
            [['code'], 'unique', 'targetClass' => Product::class],
            [LangsHelper::getNamesWithSuffix(['description', 'title']), 'string'],
            ['weight', 'integer', 'min' => 0],
        ];
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
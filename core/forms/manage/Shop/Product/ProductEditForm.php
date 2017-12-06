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
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property TagsForm $tags
 * @property ValueForm[] $values
 */
class ProductEditForm extends CompositeForm
{
    public $brandId;
    public $code;
    public $name;
    public $title;
    public $description;
    public $weight;

    private $_product;

    public function __construct(Product $product, $config = [])
    {

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $this->{'name' . $suffix} = $product->{'name' . $suffix};
            $this->{'title' . $suffix} = $product->{'title' . $suffix};
            $this->{'description' . $suffix} = $product->{'description' . $suffix};
            $this->{'meta' . $suffix} = new MetaForm($product->{'meta' . $suffix});
        }
        $this->brandId = $product->brand_id;
        $this->code = $product->code;
        $this->weight = $product->weight;
        $this->categories = new CategoriesForm($product);
        $this->tags = new TagsForm($product);
        $this->values = array_map(function (Characteristic $characteristic) use ($product) {
            return new ValueForm($characteristic, $product->getValue($characteristic->id));
        }, Characteristic::find()->orderBy('sort')->all());
        $this->_product = $product;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [LangsHelper::getNamesWithSuffix(['name']), 'required'],
            [['brandId', 'code', 'weight'], 'required'],
            [['brandId'], 'integer'],
            [['code'], 'string', 'max' => 255],
            [LangsHelper::getNamesWithSuffix(['name']), 'string', 'max' => 255],
            [['code'], 'unique', 'targetClass' => Product::class, 'filter' => $this->_product ? ['<>', 'id', $this->_product->id] : null],
            [LangsHelper::getNamesWithSuffix(['description', 'title']), 'string'],
            ['weight', 'integer', 'min' => 0],
        ];
    }

    //TODO need move this method into one file, because double with ProductCreateForm
    public function brandsList(): array
    {
        return ArrayHelper::map(Brand::find()->joinWith('translation')->orderBy('name')->asArray()->all(), 'id', 'translation.name');
    }

    protected function internalForms(): array
    {
        return [LangsHelper::getNamesWithSuffix(['meta']), 'tags', 'categories', 'values'];
    }
}
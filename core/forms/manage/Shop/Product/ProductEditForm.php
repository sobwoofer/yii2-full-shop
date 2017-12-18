<?php

namespace core\forms\manage\Shop\Product;

use core\entities\Shop\Brand\Brand;
use core\entities\Shop\Characteristic\Characteristic;
use core\entities\Shop\Product\Product;
use core\entities\Shop\Product\WarehousesProduct;
use core\entities\Shop\Warehouse;
use core\forms\CompositeForm;
use core\forms\manage\MetaForm;
use yii\helpers\ArrayHelper;
use core\helpers\LangsHelper;
use core\entities\Geo\Country;
use yii\web\UploadedFile;
use Yii;

/**
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property TagsForm $tags
 * @property WarehousesProductForm[] $warehousesProducts
 * @property ValueForm[] $values
 * @property string $code
 * @property integer $weight
 * @property string $caseCode
 * @property string $video
 * @property string $guide
 * @property UploadedFile $guideFile
 * @property integer $qtyInPack
 * @property integer $countryId
 */
class ProductEditForm extends CompositeForm
{
    public $brandId;
    public $code;
    public $name;
    public $title;
    public $description;
    public $weight;

    public $caseCode;
    public $video;
    public $guide;
    public $qtyInPack;
    public $countryId;

    public $guideFile;

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
        $this->caseCode = $product->case_code;
        $this->qtyInPack = $product->qty_in_pack;
        $this->countryId = $product->country_id;
        $this->video = $product->video;
        $this->guide = !$product->guide ? '' : Yii::getAlias('@static/guides/' . $product->guide);

        //В товара несколько складов по этому вместо вложенной формы будет массив из вложенных форм
        $this->warehousesProducts = array_map(function (WarehousesProduct $warehouse) {
            return new WarehousesProductForm($warehouse);
        }, $product->warehousesProducts);

        //в values попадает отсортированный массив из форм ValueForm уже заполненных каждая своим значениям
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
            [['brandId', 'code', 'caseCode'], 'required'],
            [['brandId', 'countryId', 'qtyInPack', 'weight'], 'integer'],
            [['code', 'caseCode' => 'case_code', 'video', 'guide'], 'string', 'max' => 255],
            [LangsHelper::getNamesWithSuffix(['name']), 'string', 'max' => 255],
            [['code', 'caseCode' => 'case_code'], 'unique', 'targetClass' => Product::class, 'filter' => $this->_product ? ['<>', 'id', $this->_product->id] : null],
            [LangsHelper::getNamesWithSuffix(['description', 'title']), 'string'],
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

    //TODO need move this methods into one file, because double with ProductCreateForm
    public function brandsList(): array
    {
        return ArrayHelper::map(Brand::find()->joinWith('translation')->orderBy('name')->asArray()->all(), 'id', 'translation.name');
    }

    public function countryList(): array
    {
        return ArrayHelper::map(Country::find()->joinWith('translation')->orderBy('name')->asArray()->all(), 'id', 'translation.name');
    }

    protected function internalForms(): array
    {
        return [LangsHelper::getNamesWithSuffix(['meta']), 'tags', 'warehousesProducts', 'categories', 'values'];
    }
}
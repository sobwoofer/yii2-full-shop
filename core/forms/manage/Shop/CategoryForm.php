<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.08.17
 * Time: 13:33
 */

namespace core\forms\manage\Shop;

use core\forms\CompositeForm;
use core\forms\manage\MetaForm;
use core\helpers\LangsHelper;
use yii\base\Model;
use core\entities\Shop\Category\Category;
use core\validators\SlugValidator;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * @property string $slug
 * @property integer $parentId
 * @property integer $beInDiscount
 * @property string $name
 * @property string $title
 * @property string $description
 * @property MetaForm $meta
 * @property string $name_ua
 * @property string $title_ua
 * @property string $description_ua
 * @property MetaForm $meta_ua
 */
class CategoryForm extends CompositeForm
{
    public $name;
    public $image;
    public $slug;
    public $beInDiscount;
    public $title;
    public $description;
    public $parentId;

    private $_category;

    public function __construct(Category $category = null, array $config = [])
    {
        if ($category) {
            foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
                $this->{'name' . $suffix} = $category->{'name' . $suffix};
                $this->{'title' . $suffix} = $category->{'title' . $suffix};
                $this->{'description' . $suffix} = $category->{'description' . $suffix};
                $this->{'meta' . $suffix} = new MetaForm($category->{'meta' . $suffix});
            }

            $this->slug = $category->slug;
            $this->beInDiscount = $category->be_in_discount;
            $this->parentId = $category->parent ? $category->parent->id : null;

            $this->_category = $category;
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
            ['beInDiscount', 'required'],
            [['image'], 'image'],
            [['parentId', 'beInDiscount'], 'integer'],
            [LangsHelper::getNamesWithSuffix(['title', 'name']), 'string', 'max' => 255],
            ['slug', 'string', 'max' => 255],
            [LangsHelper::getNamesWithSuffix(['description']), 'string'],
            ['slug', SlugValidator::class],
            ['slug', 'unique', 'targetClass' => Category::class, 'filter' => $this->_category ? ['<>', 'id', $this->_category->id] : null]
        ];
    }

    public function parentCategoriesList(): array
    {
        return ArrayHelper::map(Category::find()->localized()->orderBy('lft')->asArray()->all(), 'id',
            function (array $category) {
            return ($category['depth'] > 1 ? str_repeat('-- ', $category['depth'] - 1) . ' ' : '')
                . $category['translation']['name'];
        });
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
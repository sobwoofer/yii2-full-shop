<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.09.17
 * Time: 12:33
 */

namespace core\forms\manage\Blog;


use core\entities\Blog\Category;
use core\entities\Meta;
use core\forms\manage\MetaForm;
use yii\base\Model;
use core\helpers\LangsHelper;
use core\validators\SlugValidator;
use core\forms\CompositeForm;


/**
 * Class CategoryForm
 * @package forms\manage\Blog
 * @property MetaForm $meta
 * @property MetaForm $meta_ua
 * @property string $slug
 * @property string $name
 * @property string $title
 * @property string $description
 * @property integer $sort
 * @property string $name_ua
 * @property string $title_ua
 * @property string $description_ua
 */
class CategoryForm extends CompositeForm
{
    public $sort;
    public $slug;
    public $name;
    public $title;
    public $description;

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
            $this->sort = $category->sort;
            $this->_category = $category;
        } else {
            foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
                $this->{'meta' . $suffix} = new MetaForm();
            }
            $this->sort = Category::find()->max('sort') + 1;
        }


        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [LangsHelper::getNamesWithSuffix(['name']), 'required'],
            [LangsHelper::getNamesWithSuffix(['name', 'title']), 'string', 'max' => 255],
            [['slug'], 'string', 'max' => 255],
            [LangsHelper::getNamesWithSuffix(['description']), 'string'],
            ['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Category::class, 'filter' => $this->_category ? ['<>', 'id', $this->_category->id] : null]
        ];
    }

    public function internalForms():array
    {
        return [LangsHelper::getNamesWithSuffix(['meta'])];
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.09.17
 * Time: 12:33
 */

namespace forms\manage\Blog;


use core\entities\Blog\Category;
use core\entities\Meta;
use core\forms\manage\MetaForm;
use yii\base\Model;
use core\validators\SlugValidator;
use core\forms\CompositeForm;


/**
 * Class CategoryForm
 * @package forms\manage\Blog
 * @property MetaForm $meta
 */
class CategoryForm extends CompositeForm
{
    public $name;
    public $slug;
    public $title;
    public $description;
    public $sort;

    private $_category;

    public function __construct(Category $category = null, array $config = [])
    {
        if ($category) {
           $this->name = $category->name;
           $this->slug = $category->slug;
           $this->title = $category->title;
           $this->description = $category->description;
           $this->sort = $category->sort;
           $this->meta = new MetaForm($category->meta);
           $this->_category = $category;
        } else {
            $this->meta = new MetaForm();
            $this->sort = Category::find()->max('sort') + 1;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug', 'title'], 'string', 'max' => 255],
            [['description'], 'string'],
            ['slug', SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Category::class, 'filter' => $this->_category ? ['<>', 'id', $this->_category->id] : null]
        ];
    }

    public function internalForms():array
    {
        return ['meta'];
    }

}
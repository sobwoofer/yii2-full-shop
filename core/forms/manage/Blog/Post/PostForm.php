<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 18.09.17
 * Time: 11:47
 */


namespace core\forms\manage\Blog\Post;

use core\entities\Blog\Category;
use core\entities\Blog\Post\Post;
use core\forms\CompositeForm;
use core\forms\manage\MetaForm;
use core\validators\SlugValidator;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * @property MetaForm $meta
 * @property TagsForm $tags
 */
class PostForm extends CompositeForm
{
    public $categoryId;
    public $title;
    public $description;
    public $content;
    public $photo;

    public function __construct(Post $post = null, $config = [])
    {
        if ($post) {
            $this->categoryId = $post->category_id;
            $this->title = $post->title;
            $this->description = $post->description;
            $this->content = $post->content;
            $this->meta = new MetaForm($post->meta);
            $this->tags = new TagsForm($post);
        } else {
            $this->meta = new MetaForm();
            $this->tags = new TagsForm();
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['categoryId', 'title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['categoryId'], 'integer'],
            [['description', 'content'], 'string'],
            [['photo'], 'image'],
        ];
    }

    public function categoriesList(): array
    {
        return ArrayHelper::map(Category::find()->orderBy('sort')->asArray()->all(), 'id', 'name');
    }

    protected function internalForms(): array
    {
        return ['meta', 'tags'];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->photo = UploadedFile::getInstance($this, 'photo');
            return true;
        }
        return false;
    }
}
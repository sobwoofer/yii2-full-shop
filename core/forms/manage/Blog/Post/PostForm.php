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
use core\entities\Blog\Post\PostLang;
use core\forms\CompositeForm;
use core\forms\manage\MetaForm;
use core\helpers\LangsHelper;
use core\validators\SlugValidator;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * @property MetaForm $meta
 * @property TagsForm $tags
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $title_ua
 * @property string $description_ua
 * @property string $content_ua
 * @property PostLang[] $translation
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
            foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
                $this->{'title' . $suffix} = $post->{'title' . $suffix};
                $this->{'description' . $suffix} = $post->{'description' . $suffix};
                $this->{'content' . $suffix} = $post->{'content' . $suffix};
                $this->{'meta' . $suffix} = new MetaForm($post->{'meta' . $suffix});
            }
            $this->tags = new TagsForm($post);
        } else {
            foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
                $this->{'meta' . $suffix} = new MetaForm();
            }
            $this->tags = new TagsForm();
        }

        parent::__construct($config);
    }


    public function rules(): array
    {
        return [
            [['categoryId'], 'required'],
            [LangsHelper::getNamesWithSuffix(['title']), 'string', 'max' => 255],
            [['categoryId'], 'integer'],
            [LangsHelper::getNamesWithSuffix(['description', 'content']), 'string'],
            [['photo'], 'image'],
        ];
    }

    public function categoriesList(): array
    {

        return ArrayHelper::map(Category::find()->orderBy('sort')->localized()->asArray()->all(), 'id', 'translation.name');
    }

    protected function internalForms(): array
    {
        return [LangsHelper::getNamesWithSuffix(['meta']), 'tags', 'translates'];
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
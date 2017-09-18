<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 18.09.17
 * Time: 11:47
 */


namespace core\forms\manage\Blog\Post;

use core\entities\Blog\Post\Post;
use core\entities\Blog\Tag;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * @property array $newNames
 */
class TagsForm extends Model
{
    public $existing = [];
    public $textNew;

    public function __construct(Post $post = null, $config = [])
    {
        if ($post) {
            $this->existing = ArrayHelper::getColumn($post->tagAssignments, 'tag_id');
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['existing', 'each', 'rule' => ['integer']],
            ['textNew', 'string'],
            ['existing', 'default', 'value' => []],
        ];
    }

    public function tagsList(): array
    {
        return ArrayHelper::map(Tag::find()->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    public function getNewNames(): array
    {
        return array_filter(array_map('trim', preg_split('#\s*,\s*#i', $this->textNew)));
    }
}
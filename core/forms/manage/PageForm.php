<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 20.09.17
 * Time: 17:30
 */

namespace core\forms\manage;

use core\entities\Page\Page;
use core\forms\CompositeForm;
use core\helpers\LangsHelper;
use core\validators\SlugValidator;
use yii\helpers\ArrayHelper;

/**
 * @property string $slug
 * @property string $title
 * @property string $content
 * @property MetaForm $meta
 * @property string $title_ua
 * @property string $content_ua
 * @property MetaForm $meta_ua
* @property integer $parentId
 */
class PageForm extends CompositeForm
{
    public $title;
    public $slug;
    public $content;
    public $parentId;

    private $_page;

    public function __construct(Page $page = null, $config = [])
    {

        if ($page) {
            foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
                $this->{'title' . $suffix} = $page->{'title' . $suffix};
                $this->{'content' . $suffix} = $page->{'content' . $suffix};
                $this->{'meta' . $suffix} = new MetaForm($page->{'meta' . $suffix});
            }
            $this->slug = $page->slug;
            $this->parentId = $page->parent ? $page->parent->id : null;
            $this->_page = $page;
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
            [LangsHelper::getNamesWithSuffix(['title']), 'required'],
            ['slug', 'required'],
            [['parentId'], 'integer'],
            [LangsHelper::getNamesWithSuffix(['title']), 'string', 'max' => 255],
            ['slug', 'string', 'max' => 255],
            [LangsHelper::getNamesWithSuffix(['content']), 'string'],
            ['slug', SlugValidator::class],
            [['slug'], 'unique', 'targetClass' => Page::class, 'filter' => $this->_page ? ['<>', 'id', $this->_page->id] : null]
        ];
    }

    public function parentsList(): array
    {
        return ArrayHelper::map(Page::find()->orderBy('lft')->localized()->asArray()->all(), 'id', function (array $page) {
            return ('translation.'.$page['depth'] > 1 ? str_repeat('-- ', $page['depth'] - 1) . ' ' : '')
                . $page['translation']['title'];
        });
    }

    public function internalForms(): array
    {
        return [LangsHelper::getNamesWithSuffix(['meta'])];
    }
}
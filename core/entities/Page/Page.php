<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 20.09.17
 * Time: 17:30
 */

namespace core\entities\Page;

use core\helpers\LangsHelper;
use paulzi\nestedsets\NestedSetsBehavior;
use core\entities\behaviors\MetaBehavior;
use yii\db\ActiveRecord;
use core\entities\Meta;
use core\entities\behaviors\FilledMultilingualBehavior;
use omgdef\multilingual\MultilingualQuery;

/**
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $content
 * @property Meta $meta
 * @property string $title_ua
 * @property string $content_ua
 * @property Meta $meta_ua
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 *
 * @property Page $parent
 * @property Page[] $parents
 * @property Page[] $children
 * @property Page $prev
 * @property Page $next
 * @mixin NestedSetsBehavior
 */
class Page extends ActiveRecord
{
//    public $meta;

    public static function create(array $titles, array $contents, array $metas, $slug): self
    {
        $page = new static();

        //$this->$title, $this->$title_ua...
        foreach ($titles as $name => $value) {
            $page->{$name} = $value;
        }

        //$this->$content, $this->$content_ua...
        foreach ($contents as $name => $value) {
            $page->{$name} = $value;
        }

        //$this->$meta, $this->$meta_ua...
        foreach ($metas as $name => $value) {
            $page->{$name} = $value;
        }

        $page->slug = $slug;
        return $page;
    }

    public function edit(array $titles, array $contents, array $metas, $slug): void
    {
        //$this->$title, $this->$title_ua...
        foreach ($titles as $name => $value) {
            $this->{$name} = $value;
        }

        //$this->$content, $this->$content_ua...
        foreach ($contents as $name => $value) {
            $this->{$name} = $value;
        }

        //$this->$meta, $this->$meta_ua...
        foreach ($metas as $name => $value) {
            $this->{$name} = $value;
        }

        $this->slug = $slug;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->title;
    }

    public static function tableName(): string
    {
        return '{{%pages}}';
    }

    public function behaviors(): array
    {
        return [
//            MetaBehavior::className(),
            NestedSetsBehavior::className(),
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => false,
                'langClassName' => PageLang::className(),
                'langForeignKey' => 'page_id',
                'tableName' => '{{%pages_lang}}',
                'attributes' => [
                    'title', 'content', 'meta'
                ]
            ],
        ];
    }

    public static function find()
    {
        return new MultilingualQuery(get_called_class());
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 20.09.17
 * Time: 17:32
 */

namespace core\repositories;

use core\entities\Page\Page;

class PageRepository
{
    public function get($id): Page
    {
        if (!$page = Page::find()->multilingual()->andWhere(['id' => $id])->one()) {
            throw new NotFoundException('Page is not found.');
        }
        return $page;
    }

    public function save(Page $page): void
    {
        if (!$page->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Page $page): void
    {
        if (!$page->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
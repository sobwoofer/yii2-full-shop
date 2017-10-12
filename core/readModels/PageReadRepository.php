<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 20.09.17
 * Time: 17:31
 */


namespace core\readModels;

use core\entities\Page;

class PageReadRepository
{
    public function getAll(): array
    {
        return Page::find()->andWhere(['>', 'depth', 0])->all();
    }

    public function find($id): ?Page
    {
        return Page::findOne($id);
    }

    public function findBySlug($slug): ?Page
    {
        return Page::find()->andWhere(['slug' => $slug])->andWhere(['>', 'depth', 0])->one();
    }


}
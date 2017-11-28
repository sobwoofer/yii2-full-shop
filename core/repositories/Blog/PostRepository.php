<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 18.09.17
 * Time: 11:49
 */

namespace core\repositories\Blog;

use core\entities\Blog\Post\Post;
use core\repositories\NotFoundException;

class PostRepository
{
    public function get($id): Post
    {
        if (!$post = Post::find()->multilingual()->andWhere(['id' => $id])->one()) {
            throw new NotFoundException('Post is not found.');
        }
        return $post;
    }

    public function existsByCategory($id): bool
    {
        return Post::find()->andWhere(['category_id' => $id])->exists();
    }

    public function save(Post $post): void
    {
        if (!$post->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Post $post): void
    {
        if (!$post->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
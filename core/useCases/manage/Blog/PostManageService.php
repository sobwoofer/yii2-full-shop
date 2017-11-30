<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 18.09.17
 * Time: 11:54
 */


namespace core\useCases\manage\Blog;

use core\entities\Meta;
use core\entities\Blog\Post\Post;
use core\entities\Blog\Tag;
use core\forms\manage\Blog\Post\PostForm;
use core\helpers\LangsHelper;
use core\repositories\Blog\CategoryRepository;
use core\repositories\Blog\PostRepository;
use core\repositories\Blog\TagRepository;
use core\services\TransactionManager;

class PostManageService
{
    private $posts;
    private $categories;
    private $tags;
    private $transaction;

    public function __construct(
        PostRepository $posts,
        CategoryRepository $categories,
        TagRepository $tags,
        TransactionManager $transaction
    )
    {
        $this->posts = $posts;
        $this->categories = $categories;
        $this->tags = $tags;
        $this->transaction = $transaction;
    }

    public function create(PostForm $form): Post
    {
        $category = $this->categories->get($form->categoryId);

        //fulled variables of multi lang data
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $titles['title' . $suffix] = $form->{'title' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
            $contents['content' . $suffix] = $form->{'content' . $suffix};
            $metas['meta' . $suffix] = new Meta(
                $form->{'meta' . $suffix}->{'title' . $suffix},
                $form->{'meta' . $suffix}->description,
                $form->{'meta' . $suffix}->keywords
            );
        }

        $post = Post::create(
            $category->id,
            $titles,
            $descriptions,
            $contents,
            $metas
        );

        if ($form->photo) {
            $post->setPhoto($form->photo);
        }

        foreach ($form->tags->existing as $tagId) {
            $tag = $this->tags->get($tagId);
            $post->assignTag($tag->id);
        }

        $this->transaction->wrap(function () use ($post, $form) {
            foreach ($form->tags->newNames as $tagName) {
                if (!$tag = $this->tags->findByName($tagName)) {
                    $tag = Tag::create($tagName, $tagName);
                    $this->tags->save($tag);
                }
                $post->assignTag($tag->id);
            }
            $this->posts->save($post);
        });

        return $post;
    }

    public function edit($id, PostForm $form): void
    {
        $post = $this->posts->get($id);
        $category = $this->categories->get($form->categoryId);

        $titles = [];
        $descriptions = [];
        $contents = [];
        $metas = [];

        //fulled variables of multi lang data
        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $titles['title' . $suffix] = $form->{'title' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
            $contents['content' . $suffix] = $form->{'content' . $suffix};
            $metas['meta' . $suffix] = new Meta(
                $form->{'meta' . $suffix}->{'title' . $suffix},
                $form->{'meta' . $suffix}->description,
                $form->{'meta' . $suffix}->keywords
            );
        }

        $post->edit(
            $category->id,
            $titles,
            $descriptions,
            $contents,
            $metas
        );



        if ($form->photo) {
            $post->setPhoto($form->photo);
        }
        $this->transaction->wrap(function () use ($post, $form) {

            $post->revokeTags();
            $this->posts->save($post);

            foreach ($form->tags->existing as $tagId) {
                $tag = $this->tags->get($tagId);
                $post->assignTag($tag->id);
            }
            foreach ($form->tags->newNames as $tagName) {
                if (!$tag = $this->tags->findByName($tagName)) {
                    $tag = Tag::create($tagName, $tagName);
                    $this->tags->save($tag);
                }
                $post->assignTag($tag->id);
            }

            $this->posts->save($post);
        });
    }

    public function activate($id): void
    {
        $post = $this->posts->get($id);
        $post->activate();
        $this->posts->save($post);
    }

    public function draft($id): void
    {
        $post = $this->posts->get($id);
        $post->draft();
        $this->posts->save($post);
    }

    public function remove($id): void
    {
        $post = $this->posts->get($id);
        $this->posts->remove($post);
    }
}
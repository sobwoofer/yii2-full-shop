<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 20.09.17
 * Time: 17:32
 */

namespace core\useCases\manage;

use core\entities\Meta;
use core\entities\Page\Page;
use core\forms\manage\PageForm;
use core\helpers\LangsHelper;
use core\repositories\PageRepository;

class PageManageService
{
    private $pages;

    public function __construct(PageRepository $pages)
    {
        $this->pages = $pages;
    }

    public function create(PageForm $form): Page
    {
        $parent = $this->pages->get($form->parentId);

        $titles = [];
        $contents = [];
        $metas = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $titles['title' . $suffix] = $form->{'title' . $suffix};
            $contents['content' . $suffix] = $form->{'content' . $suffix};
            $metas['meta' . $suffix] = new Meta(
                $form->{'meta' . $suffix}->{'title' . $suffix},
                $form->{'meta' . $suffix}->{'description' . $suffix},
                $form->{'meta' . $suffix}->{'keywords' . $suffix}
            );
        }

        $page = Page::create(
            $titles,
            $contents,
            $metas,
            $form->slug
        );
        $page->appendTo($parent);
        $this->pages->save($page);
        return $page;
    }

    public function edit($id, PageForm $form): void
    {
        $page = $this->pages->get($id);
        $this->assertIsNotRoot($page);

        $titles = [];
        $contents = [];
        $metas = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $titles['title' . $suffix] = $form->{'title' . $suffix};
            $contents['content' . $suffix] = $form->{'content' . $suffix};
            $metas['meta' . $suffix] = new Meta(
                $form->{'meta' . $suffix}->{'title' . $suffix},
                $form->{'meta' . $suffix}->{'description' . $suffix},
                $form->{'meta' . $suffix}->{'keywords' . $suffix}
            );
        }


        $page->edit(
            $titles,
            $contents,
            $metas,
            $form->slug
        );

        if ($form->parentId !== $page->parent->id) {
            $parent = $this->pages->get($form->parentId);
            $page->appendTo($parent);
        }
        $this->pages->save($page);
    }

    public function moveUp($id): void
    {
        $page = $this->pages->get($id);
        $this->assertIsNotRoot($page);
        if ($prev = $page->prev) {
            $page->insertBefore($prev);
        }
        $this->pages->save($page);
    }

    public function moveDown($id): void
    {
        $page = $this->pages->get($id);
        $this->assertIsNotRoot($page);
        if ($next = $page->next) {
            $page->insertAfter($next);
        }
        $this->pages->save($page);
    }

    public function remove($id): void
    {
        $page = $this->pages->get($id);
        $this->assertIsNotRoot($page);
        $this->pages->remove($page);
    }

    private function assertIsNotRoot(Page $page): void
    {
        if ($page->isRoot()) {
            throw new \DomainException('Unable to manage the root page.');
        }
    }
}
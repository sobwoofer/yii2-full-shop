<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 10.08.17
 * Time: 16:51
 */

namespace core\tests\unit\entities\Shop\Tag;


use Codeception\Test\Unit;
use core\entities\Shop\Tag;

class EditTest extends Unit
{
    public function testSuccess()
    {
        $tag = Tag::create(
            $name = 'Name',
            $slug = 'slug'
        );

        $tag->edit($name = 'new Name', $slug = 'new-slug');

        $this->assertEquals($name, $tag->name);
        $this->assertEquals($slug, $tag->slug);
    }
}
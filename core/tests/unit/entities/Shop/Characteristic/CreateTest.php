<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.08.17
 * Time: 15:47
 */

namespace core\tests\unit\entities\Shop\Characteristic;


use Codeception\Test\Unit;
use core\entities\Shop\Characteristic\Characteristic;

class CreateTest extends Unit
{
    public function testSuccess()
    {
        $charecteristic = Charecteristic::create(
            $name = 'Name',
            $type = Characteristic::TYPE_INTEGER,
            $required = true,
            $default = 0,
            $variants = [2, 12],
            $sort = 14
        );

        $this->assertEquals($name, $charecteristic->name);
        $this->assertEquals($type, $charecteristic->type);
        $this->assertEquals($required, $charecteristic->required);
        $this->assertEquals($default, $charecteristic->default);
        $this->assertEquals($variants, $charecteristic->variants);
        $this->assertEquals($sort, $charecteristic->sort);
        $this->assertTrue($charecteristic->isSelect);
    }
}
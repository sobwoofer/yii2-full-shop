<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 29.09.17
 * Time: 11:58
 */


namespace api\tests\api;

use api\tests\ApiTester;

class HomeCest
{
    public function mainPage(ApiTester $I)
    {
        $I->sendGET('/');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }
}
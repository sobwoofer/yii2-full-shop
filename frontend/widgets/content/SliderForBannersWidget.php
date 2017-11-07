<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 07.11.17
 * Time: 15:53
 */

namespace frontend\widgets\content;


use yii\base\Widget;

class SliderForBannersWidget extends Widget
{
    public function run()
    {
        return $this->render('slideshow-images', []);
    }

}
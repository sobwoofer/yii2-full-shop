<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 01.09.17
 * Time: 15:59
 */

/* @var $shortText */
/* @var $fullText */

?>

<div class="seo-text-block">
    <div class="container">

        <div class="min-seo-text">
            <p>
                <?= $shortText ?: Yii::$app->formatter->asNtext($shortText) ?>
            </p>
        </div>

        <?php if (isset($fullText)): ?>
            <div class="max-seo-text" style="display: none;">
                <p>
                    <?= Yii::$app->formatter->asNtext($fullText) ?>
                </p>
            </div>
            <p class="text-right"><a href="#" class="read_more"> читать дальше. <span></span></a></p>
        <?php endif; ?>
    </div>
</div>


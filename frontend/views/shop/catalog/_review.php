<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 06.11.17
 * Time: 10:27
 */
/** @var $reviews \core\entities\Shop\Product\Review */
/** $reviewForm reviewForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<div class="sub-title sub-title__one_product sub-title__review_block"><strong>Отзывы пользователей</strong> <span
        class="review_block_amount"><?= count($reviews) ?></span></div>
<a id="btn__review_block" class="btn btn__review_block">Оставить отзыв</a>
<div class="review_wrapper">
    <?php foreach ($reviews as $review): ?>
        <div class="review_block clearfix" data-id="<?= $review->id ?>">
            <div class="review_block__header">
                <div class="review_block__name"><?= $review->username ?></div>
                <div class="review_block__rating">
                    <div class="star"></div>
                </div>
                <div class="review_block__date"><?= Yii::$app->formatter->asDatetime($review->created_at) ?></div>
            </div>
            <div class="review_block__message">
                <?= $review->text ?>
            </div>
            <div class="review_block__footer">
                <div class="review_block__answer"><span class="review_block__icon review_block__icon_answer"></span>ответить</div>
                <div class="review_block__comment"><span class="review_block__icon review_block__icon_comment"></span>4 ответа</div>
            </div>
        </div>
    <?php endforeach; ?>

    <a href="#" class="read_more pull-left">смотреть все отзывы <span></span></a>
</div>
<div class="live_review">
    <a class="btn btn_grey">Оставить отзыв</a>
    <div class="clearfix"></div>
    <?php if (Yii::$app->user->isGuest): ?>

        <div class="panel-panel-info">
            <div class="panel-body">
                Please <?= Html::a('Log In', ['/auth/auth/login']) ?> for writing a review.
            </div>
        </div>

    <?php else: ?>
        <div class="comment_window">
            <?php $form = ActiveForm::begin(['id' => 'form-review']) ?>
            <div class="clearfix">
                <span>Оценка</span>
                <?= $form->field($reviewForm, 'vote')->widget(\alfa6661\widgets\Raty::className(), [
                    'options' => [
                        // the HTML attributes for the widget container
                    ],
                    'pluginOptions' => [
                        // the options for the underlying jQuery Raty plugin
                        // see : https://github.com/wbotelhos/raty#options
                    ]
                ])->label(false); ?>

                <div class="pull-right close-live_review"><img src="/images/system/close_one_pro-act.png" alt=""></div>
            </div>
            <p class="clearfix">
                <?= $form->field($reviewForm, 'parentId')->hiddenInput()->label(false) ?>
                <?= $form->field($reviewForm, 'text')
                    ->textarea(['rows' => 5, 'class' => 'comment_window__text', 'placeholder' => 'Коментарий...'])
                    ->label(false) ?>
            </p>
            <?= Html::submitButton('Оставить отзыв', ['class' => 'btn btn__review_block btn__review_block_left clearfix', 'id' => 'send']) ?>

            <p class="comment_window__important clearfix">Важно! Чтобы Ваш отзыв либо комментарий прошел модерацию и был опубликован, ознакомьтесь,
                пожалуйста, с нашими правилами!
            </p>
            <?php ActiveForm::end() ?>
        </div>
    <?php endif; ?>

</div>

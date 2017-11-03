<?php

namespace core\entities\Shop\Product;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $created_at
 * @property int $user_id
 * @property string $username
 * @property int $parent_id
 * @property int $vote
 * @property string $text
 * @property bool $active
 */
class Review extends ActiveRecord
{
    public static function create($userId,  $userName, $parentId, $vote, string $text): self
    {
        $review = new static();
        $review->user_id = $userId;
        $review->username = $userName;
        $review->parent_id = $parentId;
        $review->vote = $vote;
        $review->text = $text;
        $review->created_at = time();
        $review->active = false;
        return $review;
    }

    public function edit($vote, $text): void
    {
        $this->vote = $vote;
        $this->text = $text;
    }

    public function activate(): void
    {
        $this->active = true;
    }

    public function draft(): void
    {
        $this->active = true;
    }

    public function isActive(): bool
    {
        return $this->active === true;
    }

    public function getRating(): bool
    {
        return $this->vote;
    }

    public function isIdEqualTo($id): bool
    {
        return $this->id == $id;
    }

    public static function tableName(): string
    {
        return '{{%shop_reviews}}';
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 03.11.17
 * Time: 16:00
 */

namespace core\useCases\Shop;

use core\entities\Shop\Product\Review;
use core\forms\Shop\ReviewForm;
use core\repositories\Shop\ProductRepository;
use core\repositories\UserRepository;

class ReviewService
{
    private $products;
    private $users;

    public function __construct(ProductRepository $products, UserRepository $users)
    {
        $this->products = $products;
        $this->users = $users;
    }

    public function create($product_id, $user_id, ReviewForm $form): Review
    {
        $product = $this->products->get($product_id);
        $user = $this->users->get($user_id);
        //TODO need refactore username to firstName when it will be.
        $review = $product->addReview($user->id, $user->username, $form->parentId, $form->vote, $form->text);
        $this->products->save($product);
        return $review;
    }

}
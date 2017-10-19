<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 19.10.17
 * Time: 13:18
 */


namespace core\listeners\Shop\Product;

use core\entities\Shop\Product\events\ProductAppearedInStock;
use core\entities\Shop\Product\Product;
use core\entities\User\User;
use core\repositories\UserRepository;
use yii\base\ErrorHandler;
use yii\mail\MailerInterface;

class ProductAppearedInStockListener
{
    private $users;
    private $mailer;
    private $errorHandler;

    public function __construct(UserRepository $users, MailerInterface $mailer, ErrorHandler $errorHandler)
    {
        $this->users = $users;
        $this->mailer = $mailer;
        $this->errorHandler = $errorHandler;
    }

    public function handle(ProductAppearedInStock $event): void
    {
        if ($event->product->isActive()) {
            foreach ($this->users->getAllByProductInWishList($event->product->id) as $user) {
                if ($user->isActive()) {
                    try {
                        $this->sendEmailNotification($user, $event->product);
                    } catch (\Exception $e) {
                        $this->errorHandler->handleException($e);
                    }
                }
            }
        }
    }

    private function sendEmailNotification(User $user, Product $product): void
    {
        $sent = $this->mailer
            ->compose(
                ['html' => 'shop/wishlist/available-html', 'text' => 'shop/wishlist/available-text'],
                ['user' => $user, 'product' => $product]
            )
            ->setTo($user->email)
            ->setSubject('Product is available')
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Email sending error to ' . $user->email);
        }
    }
}
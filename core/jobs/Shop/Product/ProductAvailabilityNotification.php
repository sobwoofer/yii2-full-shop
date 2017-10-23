<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 23.10.17
 * Time: 17:42
 */

namespace core\jobs\Shop\Product;

use core\entities\Shop\Product\Product;
use core\entities\User\User;
use core\repositories\UserRepository;
use yii\base\ErrorHandler;
use yii\mail\MailerInterface;
use yii\queue\Job;

class ProductAvailabilityNotification implements Job
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function execute($queue): void
    {
        foreach ($this->getUsers()->getAllByProductInWishList($this->product->id) as $user) {
            if ($user->isActive()) {
                try {
                    $this->sendEmailNotification($user, $this->product);
                } catch (\Exception $e) {
                    $this->getErrorHandler()->handleException($e);
                }
            }
        }
    }

    private function sendEmailNotification(User $user, Product $product): void
    {
        $sent = $this->getMailer()
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

    private function getUsers(): UserRepository
    {
        return \Yii::$container->get(UserRepository::class);
    }

    private function getMailer(): MailerInterface
    {
        return \Yii::$container->get(MailerInterface::class);
    }

    private function getErrorHandler(): ErrorHandler
    {
        return \Yii::$container->get(ErrorHandler::class);
    }
}
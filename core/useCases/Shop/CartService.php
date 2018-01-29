<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 08.09.17
 * Time: 15:10
 */

namespace core\useCases\Shop;

use core\cart\Cart;
use core\cart\CartItem;
use core\entities\Shop\Product\Product;
use core\forms\Shop\Cart\AddToCartForm;
use core\forms\Shop\Cart\FileAddToCartForm;
use core\repositories\Shop\ProductRepository;
use core\services\import\Cart\Reader;
use core\cart\view\LoadStatus;
use yii\web\UploadedFile;
use Yii;

class CartService
{
    private $cart;
    private $products;
    private $fileReader;

    public function __construct(Cart $cart, Reader $fileReader, ProductRepository $products)
    {
        $this->cart = $cart;
        $this->products = $products;
        $this->fileReader = $fileReader;
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }

    public function add($productId, $modifications, $quantity): void
    {
        $product = $this->products->get($productId);

        if ($modifications) {
            foreach ($modifications as $id) {
                if (!$id) {
                    continue;
                }
                $assignment = $product->getModificationAssign($id);

                if (!$assignment->isActive()) {
                    break;
                }
                $modificationAssignments[] = $assignment;
            }
        }
        $this->cart->add(new CartItem($product, $modificationAssignments ?? null, $quantity));
    }


    /**
     * @param FileAddToCartForm $form
     * @return LoadStatus[] $result
     */
    public function addFromFile(FileAddToCartForm $form): array
    {

        $items = $this->fileReader->getRows($form->uploadedFile);
        $result = [];

        foreach ($items as $key => $item) {

            try {
                if ($product = $this->products->getByCode($item->code)) {
                    $this->add($product->id, null, $item->quantity);
                    $result[] = new LoadStatus(true, 'Loaded', $item->code, $item->quantity);
                }
            } catch (\DomainException $e) {
                $result[] = new LoadStatus(false, $e->getMessage(), $item->code, $item->quantity);
            }
        }
        return $result;

    }

    public function set($id, $quantity): void
    {
        $this->cart->set($id, $quantity);
    }

    public function remove($id): void
    {
        $this->cart->remove($id);
    }

    public function removeModification($id, $itemId): void
    {
        $this->cart->removeModification($id, $itemId);
    }

    public function clear(): void
    {
        $this->cart->clear();
    }

}
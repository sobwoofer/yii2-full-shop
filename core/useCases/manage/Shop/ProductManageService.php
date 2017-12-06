<?php

namespace core\useCases\manage\Shop;

use core\entities\Meta;
use core\entities\Shop\Product\Product;
use core\entities\Shop\Tag;
use core\forms\manage\Shop\Product\CategoriesForm;
use core\forms\manage\Shop\Product\QuantityForm;
use core\forms\manage\Shop\Product\PhotosForm;
use core\forms\manage\Shop\Product\ProductCreateForm;
use core\forms\manage\Shop\Product\ProductEditForm;
use core\forms\manage\Shop\Product\ModificationForm;
use core\forms\manage\Shop\Product\PriceForm;
use core\helpers\LangsHelper;
use core\repositories\Shop\BrandRepository;
use core\repositories\Shop\CategoryRepository;
use core\repositories\Shop\ProductRepository;
use core\repositories\Shop\TagRepository;
use core\services\TransactionManager;
use core\services\import\Product\Reader;
use core\forms\manage\Shop\importForm;

class ProductManageService
{
    private $products;
    private $brands;
    private $categories;
    private $tags;
    private $transaction;
    private $reader;

    public function __construct(
        ProductRepository $products,
        BrandRepository $brands,
        CategoryRepository $categories,
        TagRepository $tags,
        TransactionManager $transaction,
        Reader $reader
    )
    {
        $this->products = $products;
        $this->brands = $brands;
        $this->categories = $categories;
        $this->tags = $tags;
        $this->transaction = $transaction;
        $this->reader = $reader;
    }

    public function create(ProductCreateForm $form): Product
    {
        $brand = $this->brands->get($form->brandId);
        $category = $this->categories->get($form->categories->main);

        $names = [];
        $titles = [];
        $descriptions = [];
        $metas = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $titles['title' . $suffix] = $form->{'title' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
            $metas['meta' . $suffix] = new Meta(
                $form->{'meta' . $suffix}->{'title' . $suffix},
                $form->{'meta' . $suffix}->{'description' . $suffix},
                $form->{'meta' . $suffix}->{'keywords' . $suffix}
            );
        }

        $product = Product::create(
            $brand->id,
            $category->id,
            $form->code,
            $form->weight,
            $form->quantity->quantity,
            $names,
            $titles,
            $descriptions,
            $metas
        );

        $product->setPrice($form->price->new, $form->price->old);

        foreach ($form->categories->others as $otherId) {
            $category = $this->categories->get($otherId);
            $product->assignCategory($category->id);
        }

        foreach ($form->values as $value) {
            $product->setValue($value->id, $value->value);
        }

        foreach ($form->photos->files as $file) {
            $product->addPhoto($file);
        }

        foreach ($form->tags->existing as $tagId) {
            $tag = $this->tags->get($tagId);
            $product->assignTag($tag->id);
        }

        $this->transaction->wrap(function () use ($product, $form) {
            foreach ($form->tags->newNames as $tagName) {
                if (!$tag = $this->tags->findByName($tagName)) {
                    $tag = Tag::create($tagName, $tagName);
                    $this->tags->save($tag);
                }
                $product->assignTag($tag->id);
            }

            $this->products->save($product);
        });

        return $product;
    }

    public function edit($id, ProductEditForm $form): void
    {
        $product = $this->products->get($id);
        $brand = $this->brands->get($form->brandId);
        $category = $this->categories->get($form->categories->main);

        $names = [];
        $titles = [];
        $descriptions = [];
        $metas = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $titles['title' . $suffix] = $form->{'title' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};
            $metas['meta' . $suffix] = new Meta(
                $form->{'meta' . $suffix}->{'title' . $suffix},
                $form->{'meta' . $suffix}->{'description' . $suffix},
                $form->{'meta' . $suffix}->{'keywords' . $suffix}
                );
        }

        $product->edit(
            $names,
            $titles,
            $descriptions,
            $metas,
            $brand->id,
            $form->code,
            $form->weight
        );

        $product->changeMainCategory($category->id);

        $this->transaction->wrap(function () use ($product, $form) {

            $product->revokeCategories();
            $product->revokeTags();
            $this->products->save($product);

            foreach ($form->categories->others as $otherId) {
                $category = $this->categories->get($otherId);
                $product->assignCategory($category->id);
            }

            foreach ($form->values as $value) {
                $product->setValue($value->id, $value->value);
            }

            foreach ($form->tags->existing as $tagId) {
                $tag = $this->tags->get($tagId);
                $product->assignTag($tag->id);
            }
            foreach ($form->tags->newNames as $tagName) {
                if (!$tag = $this->tags->findByName($tagName)) {
                    $tag = Tag::create($tagName, $tagName);
                    $this->tags->save($tag);
                }
                $product->assignTag($tag->id);
            }
            $this->products->save($product);
        });
    }

    //TODO import this projecting to the test import service
    public function import($id, importForm $form)
    {
        //обернули все в транзакцию
        $this->transaction->wrap(function() use ($form){
            $results = $this->reader->readCsv($form->file->tmpName);
            foreach ($results as $result) {
                //достаем продукт из базы по коду товара
                $product = $this->products->getByCode($result->code);
                //записываем полученные значения из файла в обьект продукта
                $product->setPrice($result->priceNew, $result->priceOld);
                $product->setModificationPriceByCode(
                    $result->modificationCode,
                    $result->modificationPrice
                );
                //сохраняем продукт в репозиторий
                $this->products->save($product);
            }
        });

    }

    public function changePrice($id, PriceForm $form): void
    {
        $product = $this->products->get($id);
        $product->setPrice($form->new, $form->old);
        $this->products->save($product);
    }

    public function changeQuantity($id, QuantityForm $form): void
    {
        $product = $this->products->get($id);
        $product->changeQuantity($form->quantity);
        $this->products->save($product);
    }

    public function activate($id): void
    {
        $product = $this->products->get($id);
        $product->activate();
        $this->products->save($product);
    }

    public function draft($id): void
    {
        $product = $this->products->get($id);
        $product->draft();
        $this->products->save($product);
    }

    public function addPhotos($id, PhotosForm $form): void
    {
        $product = $this->products->get($id);
        foreach ($form->files as $file) {
            $product->addPhoto($file);
        }
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param $photoId
     * changed sort photo in the list for product. One item up
     */
    public function movePhotoUp($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->movePhotoUp($photoId);
        $this->products->save($product);
    }

    /**
     * @param $id
     * @param $photoId
     * changed sort photo in the list for product. One item down
     */
    public function movePhotoDown($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->movePhotoDown($photoId);
        $this->products->save($product);
    }

    public function removePhoto($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->removePhoto($photoId);
        $this->products->save($product);
    }

    public function addRelatedProduct($id, $otherId): void
    {
        $product = $this->products->get($id);
        $other = $this->products->get($otherId);
        $product->assignRelatedProduct($other->id);
        $this->products->save($product);
    }

    public function removeRelatedProduct($id, $otherId): void
    {
        $product = $this->products->get($id);
        $other = $this->products->get($otherId);
        $product->revokeRelatedProduct($other->id);
        $this->products->save($product);
    }

    public function addModification($id, ModificationForm $form): void
    {
        $product = $this->products->get($id);
        $product->addModification(
            $form->code,
            $form->name,
            $form->price,
            $form->quantity
        );
        $this->products->save($product);
    }

    public function editModification($id, $modificationId, ModificationForm $form): void
    {
        $product = $this->products->get($id);
        $product->editModification(
            $modificationId,
            $form->code,
            $form->name,
            $form->price,
            $form->quantity
        );
        $this->products->save($product);
    }

    public function removeModification($id, $modificationId): void
    {
        $product = $this->products->get($id);
        $product->removeModification($modificationId);
        $this->products->save($product);
    }


    public function remove($id): void
    {
        $product = $this->products->get($id);
        $this->products->remove($product);
    }
}
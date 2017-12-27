<?php

namespace core\useCases\manage\Shop;

use core\entities\Meta;
use core\entities\Shop\Product\Product;
use core\entities\Shop\Tag;
use core\forms\manage\Shop\Product\CategoriesForm;
use core\forms\manage\Shop\Product\ModificationAssignmentsForm;
use core\forms\manage\Shop\Product\PhotosForm;
use core\forms\manage\Shop\Product\Photos360Form;
use core\forms\manage\Shop\Product\ProductCreateForm;
use core\forms\manage\Shop\Product\ProductEditForm;
use core\forms\manage\Shop\Product\ModificationForm;
use core\forms\manage\Shop\Product\WarehousesProductForm;
use core\helpers\LangsHelper;
use core\repositories\Shop\BrandRepository;
use core\repositories\Shop\CategoryRepository;
use core\repositories\Shop\ModificationRepository;
use core\repositories\Shop\ProductRepository;
use core\repositories\Shop\TagRepository;
use core\repositories\Geo\CountryRepository;
use core\repositories\Shop\WarehouseRepository;
use core\services\TransactionManager;
use core\services\import\Product\Reader;
use core\forms\manage\Shop\importForm;
use yii\web\UploadedFile;
use Yii;

class ProductManageService
{
    private $products;
    private $brands;
    private $categories;
    private $tags;
    private $countries;
    private $warehouses;
    private $transaction;
    private $modifications;
    private $reader;

    public function __construct(
        ProductRepository $products,
        BrandRepository $brands,
        CountryRepository $countries,
        CategoryRepository $categories,
        WarehouseRepository $warehouses,
        ModificationRepository $modifications,
        TagRepository $tags,
        TransactionManager $transaction,
        Reader $reader
    )
    {
        $this->products = $products;
        $this->brands = $brands;
        $this->countries = $countries;
        $this->categories = $categories;
        $this->warehouses = $warehouses;
        $this->modifications = $modifications;
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
            $form->caseCode,
            $form->video,
            $form->qtyInPack,
            $form->countryId,
            $names,
            $titles,
            $descriptions,
            $metas
        );

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

        foreach ($form->photos360->files as $file) {
            $product->addPhoto360($file);
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

            foreach ($form->warehousesProducts as $warehousesProduct) {
                $this->addWarehousesProduct($product->id, $warehousesProduct->getWarehouseId(), $warehousesProduct);
            }

        });




        if ($form->guideFile instanceof UploadedFile) {
            $product->addGuide($form->guideFile);
            $this->products->save($product);
        }

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
            $form->weight,
            $form->caseCode,
            $form->video,
            $form->qtyInPack,
            $form->countryId
        );

        $product->changeMainCategory($category->id);

        if ($form->guideFile instanceof UploadedFile) {
            $product->addGuide($form->guideFile);
        }

        $this->transaction->wrap(function () use ($product, $form) {

            $product->revokeCategories();
            $product->revokeTags();
            $this->products->save($product);


            foreach ($form->warehousesProducts as $warehousesProduct) {
                $this->editWarehousesProduct($product->id, $warehousesProduct->id, $warehousesProduct);
            }

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

    //Photo
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
    //Photo 360
    public function addPhotos360($id, Photos360Form $form): void
    {
        $product = $this->products->get($id);
        foreach ($form->files as $file) {
            $product->addPhoto360($file);
        }
        $this->products->save($product);
    }

    public function removePhoto360($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->removePhoto360($photoId);
        $this->products->save($product);
    }

    public function movePhoto360Up($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->movePhoto360Up($photoId);
        $this->products->save($product);
    }

    public function movePhoto360Down($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->movePhoto360Down($photoId);
        $this->products->save($product);
    }

    //Related Products
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

    public function addBuyWithProduct($id, $otherId): void
    {
        $product = $this->products->get($id);
        $other = $this->products->get($otherId);
        $product->assignBuyWithProduct($other->id);

        $this->products->save($product);
    }

    public function removeBuyWithProduct($id, $otherId): void
    {
        $product = $this->products->get($id);
        $other = $this->products->get($otherId);
        $product->revokeBuyWithProduct($other->id);
        $this->products->save($product);
    }

    //Modification Assignments

    /**
     * @param $id //product_id
     * @param ModificationAssignmentsForm $form
     */
    public function addModificationAssign($id, ModificationAssignmentsForm $form)
    {
        $product = $this->products->get($id);
        $modification = $this->modifications->get($form->modificationId);
        $product->assignModification($modification->id, $form->minQty, $form->status);

        $this->products->save($product);
    }

    /**
     * @param $productId
     * @param ModificationAssignmentsForm $form
     */
    public function editModificationAssign($productId, ModificationAssignmentsForm $form)
    {
        $product = $this->products->get($productId);
        $modification = $this->modifications->get($form->modificationId);
        $product->editModificationAssign($modification->id, $form->minQty, $form->status);

        $this->products->save($product);
    }


    public function removeModificationAssign($productId, $modificationId)
    {
        $product = $this->products->get($productId);
        $modification = $this->modifications->get($modificationId);
        $product->revokeModification($modification->id);

        $this->products->save($product);
    }


    //Warehouses product

    /**
     * @param $productId
     * @param $warehouseId
     * @param WarehousesProductForm $form
     */
    public function addWarehousesProduct($productId, $warehouseId, WarehousesProductForm $form): void
    {
        $product = $this->products->get($productId);
        $warehouse = $this->warehouses->get($warehouseId);

        $product->addWarehousesProduct(
            $warehouse->id,
            $product->id,
            $form->extraStatusId,
            $form->deliveryTermId,
            $form->externalStatus,
            $form->price,
            $form->quantity,
            $form->special,
            $form->specialStatus,
            $form->specialStart,
            $form->specialEnd
        );

        $this->products->save($product);

    }

    /**
     * @param $productId
     * @param $warehouseProductId
     * @param WarehousesProductForm $form
     */
    public function editWarehousesProduct($productId, $warehouseProductId, WarehousesProductForm $form): void
    {
        $product = $this->products->get($productId);

        $product->editWarehousesProduct(
            $warehouseProductId,
            $form->extraStatusId,
            $form->deliveryTermId,
            $form->externalStatus,
            $form->price,
            $form->quantity,
            $form->special,
            $form->specialStatus,
            $form->specialStart,
            $form->specialEnd
        );

        $this->products->save($product);
    }

    public function remove($id): void
    {
        $product = $this->products->get($id);
        $this->products->remove($product);
    }
}
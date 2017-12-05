<?php

namespace core\useCases\manage\Shop;

use core\entities\Meta;
use core\entities\Shop\Brand\Brand;
use core\forms\manage\Shop\BrandForm;
use core\helpers\LangsHelper;
use core\repositories\Shop\BrandRepository;
use core\repositories\Shop\ProductRepository;
use yii\helpers\Inflector;

class BrandManageService
{
    private $brands;
    private $products;

    public function __construct(BrandRepository $brands, ProductRepository $products)
    {
        $this->brands = $brands;
        $this->products = $products;
    }

    public function create(BrandForm $form): Brand
    {
        $names = [];
        $descriptions = [];
        $metas = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};

            $metas['meta' . $suffix] = new Meta(
                $form->{'meta' . $suffix}->{'title' . $suffix},
                $form->{'meta' . $suffix}->{'description' . $suffix},
                $form->{'meta' . $suffix}->{'keywords' . $suffix}
            );
        }

        $brand = Brand::create(
            $names,
            $descriptions,
            $metas,
            $form->slug ?: Inflector::slug($form->name)
        );
        if ($form->image) {
            $brand->setPhoto($form->image);
        }

        $this->brands->save($brand);
        return $brand;
    }

    public function edit($id, BrandForm $form): void
    {

        $names = [];
        $descriptions = [];
        $metas = [];

        foreach (LangsHelper::getWithSuffix() as $suffix => $lang) {
            $names['name' . $suffix] = $form->{'name' . $suffix};
            $descriptions['description' . $suffix] = $form->{'description' . $suffix};

            $metas['meta' . $suffix] = new Meta(
                $form->{'meta' . $suffix}->{'title' . $suffix},
                $form->{'meta' . $suffix}->{'description' . $suffix},
                $form->{'meta' . $suffix}->{'keywords' . $suffix}
            );
        }

        $brand = $this->brands->get($id);
        $brand->edit(
            $names,
            $descriptions,
            $metas,
            $form->slug ?: Inflector::slug($form->name)
        );

        if ($form->image) {
            $brand->setPhoto($form->image);
        }
        $this->brands->save($brand);
    }

    public function remove($id): void
    {
        $brand = $this->brands->get($id);
        if ($this->products->existByBrand($brand->id)) {
            throw new \DomainException('Unable to remove brand with products.');
        }
        $this->brands->remove($brand);
    }
}
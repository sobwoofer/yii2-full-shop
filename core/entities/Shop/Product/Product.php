<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 16.08.17
 * Time: 9:58
 */

namespace core\entities\Shop\Product;

use core\entities\EventTrait;
use core\entities\Shop\Modification\Modification;
use core\entities\Shop\Modification\ModificationGroup;
use core\helpers\LocationHelper;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use core\entities\AggregateRoot;
use core\entities\behaviors\MetaBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use core\entities\Shop\Product\events\ProductAppearedInStock;
use yii\db\Exception;
use core\entities\User\WishlistItem;
use core\entities\Shop\Product\queries\ProductQuery;
use core\entities\Meta;
use core\entities\Shop\Brand\Brand;
use core\entities\Shop\Category\Category;
use core\entities\Shop\Tag;
use yii\web\UploadedFile;
use core\entities\Geo\Country;
use core\entities\behaviors\FilledMultilingualBehavior;
use Yii;

/**
 * @property integer $id
 * @property integer $created_at
 * @property string $code
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $name_ua
 * @property string $title_ua
 * @property string $description_ua
 * @property integer $category_id
 * @property integer $brand_id
 * @property integer $rating
 * @property integer $main_photo_id
 * @property integer $status
 * @property integer $weight
 * @property string $case_code
 * @property string $video
 * @property string $guide
 * @property integer $qty_in_pack
 * @property integer $country_id
 *
 * @property Meta $meta
 * @property Meta $meta_ua
 * @property Brand $brand
 * @property Country $country
 * @property Category $category
 * @property RelatedAssignment[] $relatedAssignments
 * @property BuyWithAssignment[] $buyWithAssignments
 * @property CategoryAssignment[] $categoryAssignments
 * @property Category[] $categories
 * @property ModificationAssignment[] $modificationAssignments
 * @property Modification[] $modifications
 * @property ModificationGroup[] $modificationGroups
 * @property TagAssignment[] $tagAssignments
 * @property Tag[] $tags
 * @property Value[] $values
 * @property Photo[] $photos
 * @property WarehousesProduct[] $warehousesProducts
 * @property WarehousesProduct $warehousesProduct
 * @property Photo360[] $photos360
 * @property Photo $mainPhoto
 * @property Review[] $reviews
 */
class Product extends ActiveRecord implements AggregateRoot
{
    use EventTrait;

    const STATUS_DRAFT = 0; //off
    const STATUS_ACTIVE = 1; //on

    const EXTERNAL_STATUS_NOT_AVAILABLE = 0; //нет в наличии
    const EXTERNAL_STATUS_ARE_AVAILABLE = 1; //есть в наличии
    const EXTERNAL_STATUS_EXPECTED = 2; //ожидается

    public static function create(
        $brandId,
        $categoryId,
        $code,
        $weight,
        $caseCode,
        $video,
        $qtyInPack,
        $countryId,
        array $names,
        array $titles,
        array $descriptions,
        array $metas
    ): Product
    {
        $product = new static();
        $product->brand_id = $brandId;
        $product->category_id = $categoryId;
        $product->code = $code;
        $product->weight = $weight;
        $product->case_code = $caseCode;
        $product->video = $video;
        $product->qty_in_pack = $qtyInPack;
        $product->country_id = $countryId;
        $product->created_at = time();
        $product->status = self::STATUS_DRAFT;

        //$this->name, $this->name_ua...
        foreach ($names as $name => $value) {
            $product->{$name} = $value;
        }
        //$this->title, $this->title_ua...
        foreach ($titles as $name => $value) {
            $product->{$name} = $value;
        }
        //$this->description, $this->description_ua...
        foreach ($descriptions as $name => $value) {
            $product->{$name} = $value;
        }
        //$this->meta, $this->meta_ua...
        foreach ($metas as $name => $value) {
            $product->{$name} = $value;
        }

        return $product;
    }

    public function changeQuantity($quantity): void
    {
        if ($this->modifications) {
            throw new \DomainException('Change modifications quantity.');
        }
        $this->setQuantity($quantity);
    }

    public function edit(
        $names,
        $titles,
        $descriptions,
        $metas,
        $brandId,
        $code,
        $weight,
        $caseCode,
        $video,
        $qtyInPack,
        $countryId
    ): void
    {

        $this->brand_id = $brandId;
        $this->code = $code;
        $this->weight = $weight;
        $this->case_code = $caseCode;
        $this->video = $video;
        $this->qty_in_pack = $qtyInPack;
        $this->country_id = $countryId;

        //$this->name, $this->name_ua...
        foreach ($names as $name => $value) {
            $this->{$name} = $value;
        }
        //$this->title, $this->title_ua...
        foreach ($titles as $name => $value) {
            $this->{$name} = $value;
        }
        //$this->description, $this->description_ua...
        foreach ($descriptions as $name => $value) {
            $this->{$name} = $value;
        }
        //$this->meta, $this->meta_ua...
        foreach ($metas as $name => $value) {
            $this->{$name} = $value;
        }
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->name;
    }

    public function changeMainCategory($categoryId): void
    {
        $this->category_id = $categoryId;
    }

    public function activate(): void
    {
        if ($this->isActive()) {
            throw new \DomainException('Product is already active.');
        }
        $this->status = self::STATUS_ACTIVE;
    }

    public function draft(): void
    {
        if ($this->isDraft()) {
            throw new \DomainException('Product is already draft.');
        }
        $this->status = self::STATUS_DRAFT;
    }

    public function isActive(): bool
    {
        return $this->status == self::STATUS_ACTIVE;
    }


    public function isDraft(): bool
    {
        return $this->status == self::STATUS_DRAFT;
    }

    public function isAvailable(): bool
    {
        return $this->warehousesProduct->extraStatus->external_id != self::EXTERNAL_STATUS_NOT_AVAILABLE;
    }

    public function canChangeQuantity(): bool
    {
        return !$this->modifications;
    }

    /**
     * @param integer $quantity
     * @param ModificationAssignment[] $modificationAssignments
     * @return void
     */
    public function canBeCheckout($modificationAssignments, $quantity): void
    {
        if ($modificationAssignments) {
            foreach ($modificationAssignments as $assignment) {
                if ($assignment->min_qty > $quantity){
                    throw new \DomainException('Quantity is less for someone modification.');
                }
            }
        }
        if ($quantity <= $this->warehousesProduct->quantity) {
            throw new \DomainException('Quantity is too big.');
        }
    }

    public function checkout($modificationId, $quantity): void
    {
        if ($modificationId) {
            $modifications = $this->modifications;
            foreach ($modifications as $i => $modification) {
                if ($modification->isIdEqualTo($modificationId)) {
                    $modification->checkout($quantity);
                    $this->updateModifications($modifications);
                    return;
                }
            }
        }
        // Not throw Exception if quantity not available
//        if ($quantity > $this->warehousesProduct->quantity) {
//            throw new \DomainException('Only ' . $this->warehousesProduct->quantity . ' items are available.');
//        }
        $this->setQuantity($this->warehousesProduct->quantity - 1);
    }

    private function setQuantity($quantity): void
    {
        if ($this->warehousesProduct->quantity == 0 && $quantity > 0) {
            $this->recordEvent(new ProductAppearedInStock($this));
        }
        $this->warehousesProduct->quantity = $quantity;
    }

    public function setValue($id, $value): void
    {
        $values = $this->values;
        foreach ($values as $val) {
            if ($val->isForCharacteristic($id)) {
                $val->change($value);
                $this->values = $values;
                return;
            }
        }
        $values[] = Value::create($id, $value);
        $this->values = $values;
    }

    public function getValue($id): Value
    {
        $values = $this->values;
        foreach ($values as $val) {
            if ($val->isForCharacteristic($id)) {
                return $val;
            }
        }
        return Value::blank($id);
    }

    // Modification

    public function getModificationAssign($id): ModificationAssignment
    {
        foreach ($this->modificationAssignments as $assignment) {
            if ($assignment->isForModification($id)) {
                return $assignment;
            }
        }
        throw new \DomainException('ModificationAssignment is not found.');
    }

    public function getModificationPrice($id): int
    {
        foreach ($this->modifications as $modification) {
            if ($modification->isIdEqualTo($id)) {
                return $modification->price ?? 0;
            }
        }
        throw new \DomainException('Modification is not found.');
    }



//    public function editModification($id, $code, $name, $price, $quantity): void
//    {
//        $modifications = $this->modifications;
//        foreach ($modifications as $i => $modification) {
//            if ($modification->isIdEqualTo($id)) {
//                $modification->edit($code, $name, $price, $quantity);
//                $this->updateModifications($modifications);
//                return;
//            }
//        }
//        throw new \DomainException('Modification is not found.');
//    }

//    public function removeModification($id): void
//    {
//        $modifications = $this->modifications;
//        foreach ($modifications as $i => $modification) {
//            if ($modification->isIdEqualTo($id)) {
//                unset($modifications[$i]);
//                $this->updateModifications($modifications);
//                return;
//            }
//        }
//        throw new \DomainException('Modification is not found.');
//    }

    private function updateModificationAssignments(array $modificationAssignments): void
    {
        $this->modificationAssignments = $modificationAssignments;
    }


//    public function addModificationAssign($minQty, $status, $modificationId): void
//    {
//        $modificationAssignments = $this->modificationAssignments;
//        foreach ($modificationAssignments as $modificationAssignment) {
//            if ($modificationAssignment->modification->isIdEqualTo($modificationId)) {
//                throw new \DomainException('Modification already exists.');
//            }
//        }
//
//        $modifications[] = ModificationAssignment::create($modificationId, $minQty, $status);
//        $this->updateModifications($modifications);
//    }

    // Modifications

    /**
     * @param $id
     * @param $minQty
     * @param $status
     */
    public function assignModification($id,  $minQty, $status): void
    {
        $assignments = $this->modificationAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForModification($id)) {
                throw new \DomainException('Modification already exists.');
            }
        }
        $assignments[] = ModificationAssignment::create($id, $minQty, $status);
        $this->updateModificationAssignments($assignments);
    }

    public function editModificationAssign($id,  $minQty, $status)
    {
        $assignments = $this->modificationAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForModification($id)) {
                $assignment->edit($minQty, $status);
                $this->updateModificationAssignments($assignments);
                return;
            }
        }
        throw new \DomainException('Modification is not found.');
    }

    public function revokeModification($id): void
    {
        $assignments = $this->modificationAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForModification($id)) {
                unset($assignments[$i]);
                $this->modificationAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not fount');
    }

    public function revokeModifications(): void
    {
        $this->modificationAssignments = [];
    }


    //warehouses products
    public function addWarehousesProduct(
        $warehouseId,
        $productId,
        $extraStatusId,
        $deliveryTermId,
        $externalStatus,
        $price,
        $quantity,
        $special,
        $specialStatus,
        $specialStart,
        $specialEnd
    ): void
    {

        $warehousesProducts = $this->warehousesProducts;

        $warehousesProducts[] = WarehousesProduct::create(
            $warehouseId,
            $productId,
            $extraStatusId,
            $deliveryTermId,
            $externalStatus,
            $price,
            $quantity,
            $special,
            $specialStatus,
            $specialStart,
            $specialEnd
        );

        $this->updateWarehousesProducts($warehousesProducts);
    }

    public function editWarehousesProduct(
        $id,
        $extraStatusId,
        $deliveryTermId,
        $externalStatus,
        $price,
        $quantity,
        $special,
        $specialStatus,
        $specialStart,
        $specialEnd
    ): void
    {
        $warehousesProducts = $this->warehousesProducts;

        foreach ($warehousesProducts as $i => $warehousesProduct) {
            if ($warehousesProduct->isIdEqualTo($id)) {
                $warehousesProduct->edit(
                    $extraStatusId,
                    $deliveryTermId,
                    $externalStatus,
                    $price,
                    $quantity,
                    $special,
                    $specialStatus,
                    $specialStart,
                    $specialEnd
                );
                $this->updateWarehousesProducts($warehousesProducts);
                return;
            }
        }
        throw new \DomainException('Modification is not found.');
    }

    private function updateWarehousesProducts(array $warehousesProducts): void
    {
        $this->warehousesProducts = $warehousesProducts;
    }

    // Categories

    public function assignCategory($id): void
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForCategory($id)) {
                return;
            }
        }
        $assignments = CategoryAssignment::create($id);
        $this->categoryAssignments = $assignments;
    }

    public function revokeCategory($id): void
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForCategory($id)) {
                unset($assignments[$i]);
                $this->categoryAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not fount');
    }

    public function revokeCategories(): void
    {
        $this->categoryAssignments = [];
    }

    // Tags

    public function assignTag($id): void
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForTag($id)) {
                return;
            }
        }
        $assignments[] = TagAssignment::create($id);
        $this->tagAssignments = $assignments;
    }

    public function revokeTag($id): void
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForTag($id)) {
                unset($assignments[$i]);
                $this->tagAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not found.');
    }

    public function revokeTags(): void
    {
        $this->tagAssignments = [];
    }

    // Photos

    public function addPhoto(UploadedFile $file): void
    {
        $photos = $this->photos;
        $photos[] = Photo::create($file);
        $this->updatePhotos($photos);
    }

    public function addPhoto360(UploadedFile $file): void
    {
        $photos = $this->photos360;
        $photos[] = Photo360::create($file);
        $this->updatePhotos360($photos);
    }

    public function removePhoto($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                unset($photos[$i]);
                $this->updatePhotos($photos);
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    public function removePhoto360($id): void
    {
        $photos = $this->photos360;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                unset($photos[$i]);
                $this->updatePhotos360($photos);
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    public function addGuide(UploadedFile $file): void
    {
        if ($file) {
            $file->saveAs(Yii::getAlias('@staticRoot/guides/' . $this->id . '.' . $file->extension));
            $this->guide = $this->id. '.'. $file->extension;
        }
    }


    public function removePhotos(): void
    {
        $this->updatePhotos([]);
    }

    public function removePhotos360(): void
    {
        $this->updatePhotos360([]);
    }

    public function movePhotoUp($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                if ($prev = $photos[$i - 1] ?? null) {
                    $photos[$i - 1] = $photo;
                    $photos[$i] = $prev;
                    $this->updatePhotos($photos);
                }
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    public function movePhoto360Up($id): void
    {
        $photos = $this->photos360;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                if ($prev = $photos[$i - 1] ?? null) {
                    $photos[$i - 1] = $photo;
                    $photos[$i] = $prev;
                    $this->updatePhotos360($photos);
                }
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    public function movePhotoDown($id): void
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                if ($next = $photos[$i + 1] ?? null) {
                    $photos[$i] = $next;
                    $photos[$i + 1] = $photo;
                    $this->updatePhotos($photos);
                }
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    public function movePhoto360Down($id): void
    {
        $photos = $this->photos360;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                if ($next = $photos[$i + 1] ?? null) {
                    $photos[$i] = $next;
                    $photos[$i + 1] = $photo;
                    $this->updatePhotos360($photos);
                }
                return;
            }
        }
        throw new \DomainException('Photo is not found.');
    }

    private function updatePhotos(array $photos): void
    {
        foreach ($photos as $i => $photo) {
            $photo->setSort($i);
        }
        $this->photos = $photos;
        $this->populateRelation('mainPhoto', reset($photos));
    }

    private function updatePhotos360(array $photos): void
    {
        foreach ($photos as $i => $photo) {
            $photo->setSort($i);
        }
        $this->photos360 = $photos;
    }

    // Related products

    public function assignRelatedProduct($id): void
    {
        $assignments = $this->relatedAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForProduct($id)) {
                return;
            }
        }
        $assignments[] = RelatedAssignment::create($id);
        $this->relatedAssignments = $assignments;
    }

    public function revokeRelatedProduct($id): void
    {
        $assignments = $this->relatedAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForProduct($id)) {
                unset($assignments[$i]);
                $this->relatedAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not found.');
    }

    // Buy with products

    public function assignBuyWithProduct($id): void
    {
        $assignments = $this->buyWithAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForProduct($id)) {
                return;
            }
        }
        $assignments[] = BuyWithAssignment::create($id);
        $this->buyWithAssignments = $assignments;
    }

    public function revokeBuyWithProduct($id): void
    {
        $assignments = $this->buyWithAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForProduct($id)) {
                unset($assignments[$i]);
                $this->buyWithAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not found.');
    }

    // Reviews

    public function addReview($userId, $userName, $parentId, $vote, $text): Review
    {
        $reviews = $this->reviews;
        $reviews[] = $review = Review::create($userId, $userName, $parentId, $vote, $text);
        $this->updateReviews($reviews);
        return $review;
    }

    public function editReview($id, $vote, $text): void
    {
        $this->doWithReview($id, function (Review $review) use ($vote, $text) {
            $review->edit($vote, $text);
        });
    }

    public function activateReview($id): void
    {
        $this->doWithReview($id, function (Review $review) {
            $review->activate();
        });
    }

    public function draftReview($id): void
    {
        $this->doWithReview($id, function (Review $review) {
            $review->draft();
        });
    }

    public function getReview($id): Review
    {
        foreach ($this->reviews as $review) {
            if ($review->isIdEqualTo($id)) {
                return $review;
            }
        }
        throw new \DomainException('Review is not found.');
    }

    /**
     * @param $id
     * @param callable $callback
     * Callback function doing with review and after did, recalculate rating
     */
    private function doWithReview($id, callable $callback): void
    {
        $reviews = $this->reviews;
        foreach ($reviews as $review) {
            if ($review->isIdEqualTo($id)) {
                $callback($review);
                $this->updateReviews($reviews);
                return;
            }
        }
        throw new \DomainException('Review is not found.');
    }

    public function removeReview($id): void
    {
        $reviews = $this->reviews;
        foreach ($reviews as $i => $review) {
            if ($review->isIdEqualTo($id)) {
                unset($reviews[$i]);
                $this->updateReviews($reviews);
                return;
            }
        }
        throw new \DomainException('Review is not found.');
    }

    private function updateReviews(array $reviews): void
    {
        $amount = 0;
        $total = 0;

        foreach ($reviews as $review) {
            if ($review->isActive()) {
                $amount++;
                $total += $review->getRating();
            }
        }

        $this->reviews = $reviews;
        $this->rating = $amount ? $total / $amount : null;
    }

    ########################## Start Relations with other entities tables

    public function getBrand(): ActiveQuery
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    public function getCountry(): ActiveQuery
    {
        return $this->hasOne(Country::class, ['id' => 'country_id']);
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getCategoryAssignments(): ActiveQuery
    {
        return $this->hasMany(CategoryAssignment::class, ['product_id' => 'id']);
    }

    public function getCategories(): ActiveQuery
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])->via('categoryAssignments');
    }

    public function getTagAssignments(): ActiveQuery
    {
        return $this->hasMany(TagAssignment::class, ['product_id' => 'id']);
    }

    public function getWarehousesProducts(): ActiveQuery
    {
        return $this->hasMany(WarehousesProduct::class, ['product_id' => 'id']);
    }

    /**
     * @return ActiveQuery current or default warehouse of user
     */
    public function getWarehousesProduct(): ActiveQuery
    {

        return $this->hasOne(WarehousesProduct::class, ['product_id' => 'id'])->where([
            'warehouse_id' => LocationHelper::getWarehouseId()
        ]);
    }

    public function getTags(): ActiveQuery
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->via('tagAssignments');
    }

    public function getModificationAssignments(): ActiveQuery
    {
        return $this->hasMany(ModificationAssignment::class, ['product_id' => 'id']);
    }

    public function getModifications(): ActiveQuery
    {
        return $this->hasMany(Modification::class, ['id' => 'modification_id'])->via('modificationAssignments');
    }

    public function getModificationGroups(): ActiveQuery
    {
        return $this->hasMany(ModificationGroup::class, ['id' => 'group_id'])->via('modifications');
    }

    public function getValues(): ActiveQuery
    {
        return $this->hasMany(Value::class, ['product_id' => 'id']);
    }

    public function getPhotos(): ActiveQuery
    {
        return $this->hasMany(Photo::class, ['product_id' => 'id'])->orderBy('sort');
    }

    public function getMainPhoto(): ActiveQuery
    {
        return $this->hasOne(Photo::class, ['id' => 'main_photo_id']);
    }

    public function getPhotos360(): ActiveQuery
    {
        return $this->hasMany(Photo360::class, ['product_id' => 'id'])->orderBy('sort');
    }

//    public function getMainPhoto360(): ActiveQuery
//    {
//        return $this->hasOne(Photo360::class, ['id' => 'main_photo_id']);
//    }

    public function getRelatedAssignments(): ActiveQuery
    {
        return $this->hasMany(RelatedAssignment::class, ['product_id' => 'id']);
    }

    public function getRelated(): ActiveQuery
    {
        return $this->hasMany(RelatedAssignment::class, ['related_id' => 'id']);
    }

    public function getBuyWithAssignments(): ActiveQuery
    {
        return $this->hasMany(BuyWithAssignment::class, ['product_id' => 'id']);
    }

    public function getBuyWith(): ActiveQuery
    {
        return $this->hasMany(BuyWithAssignment::class, ['related_id' => 'id']);
    }

//    public function getRelateds(): ActiveQuery
//    {
//        return $this->hasMany(Product::class, ['id' => 'related_id'])->via('relatedAssignments');
//    }

    public function getReviews(): ActiveQuery
    {
        return $this->hasMany(Review::class, ['product_id' => 'id']);
    }

    public function getWishlistItems(): ActiveQuery
    {
        return $this->hasMany(WishlistItem::class, ['product_id' => 'id']);
    }

    ########################## End Relations with other entities tables

    public static function tableName(): string
    {
        return '{{%shop_products}}';
    }

    /**
     * @return array
     * Поведение MetaBehavior конвертирует мета описание в json или из него, перед сохранением или после селекта.
     * Поведение SaveRelationsBehavior Автоматически пишет id сущьности или связи в сохраняемую таблицу.
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => [
                    'categoryAssignments',
                    'tagAssignments',
                    'relatedAssignments',
                    'buyWithAssignments',
                    'warehousesProducts',
                    'modificationAssignments',
                    'modifications',
                    'values',
                    'photos',
                    'photos360',
                    'reviews'
                ],
            ],
            'ml' => [
                'class' => FilledMultilingualBehavior::className(),
                'defaultLanguage' => 'ru',
                'dynamicLangClass' => false,
                'langClassName' => ProductLang::className(),
                'langForeignKey' => 'product_id',
                'tableName' => '{{%shop_products_lang}}',
                'attributes' => [
                    'name', 'title', 'description', 'meta'
                ]
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function beforeDelete(): bool
    {
        if (parent::beforeDelete()) {
            foreach ($this->photos360 as $photo) {
                $photo->delete();
            }
            foreach ($this->photos360 as $photo) {
                $photo->delete();
            }
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes): void
    {
        $related = $this->getRelatedRecords();
        parent::afterSave($insert, $changedAttributes);
        if (array_key_exists('mainPhoto', $related)) {
            $this->updateAttributes(['main_photo_id' => $related['mainPhoto'] ? $related['mainPhoto']->id : null]);
        }
    }

    public static function find(): ProductQuery
    {
        return new ProductQuery(static::class);
    }

}
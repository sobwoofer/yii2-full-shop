<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 08.09.17
 * Time: 15:55
 */

namespace core\cart\storage;

use core\cart\CartItem;
use core\entities\Shop\Product\Product;
use yii\db\Connection;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class DbStorage implements StorageInterface
{
    private $userId;
    private $db;

    public function __construct($userId, Connection $db)
    {
        $this->userId = $userId;
        $this->db = $db;
    }

    public function load(): array
    {
        $rows = (new Query())
            ->select('*')
            ->from('{{%shop_cart_items}}')
            ->where(['user_id' => $this->userId])
            ->orderBy(['product_id' => SORT_ASC, 'modifications_json' => SORT_ASC])
            ->all($this->db);

        return array_map(function (array $row) {
            /** @var Product $product */
            if ($product = Product::find()->active()->andWhere(['id' => $row['product_id']])->one()) {
                return new CartItem($product, array_map(function($modificationId) use ($product){
                    return $product->getModificationAssign($modificationId);
                }, Json::decode($row['modifications_json'])) ?? null, $row['quantity']);
            }
            return false;
        }, $rows);
    }

    public function save(array $items): void
    {
        $this->db->createCommand()->delete('{{%shop_cart_items}}', [
            'user_id' => $this->userId,
        ])->execute();

        $this->db->createCommand()->batchInsert(
            '{{%shop_cart_items}}',
            [
                'user_id',
                'product_id',
                'modifications_json',
                'quantity'
            ],
            array_map(function (CartItem $item) {
                return [
                    'user_id' => $this->userId,
                    'product_id' => $item->getProductId(),
                    'modifications_json' => Json::encode(ArrayHelper::getColumn($item->getModifications(), 'id')),
                    'quantity' => $item->getQuantity(),
                ];
            }, $items)
        )->execute();
    }
}
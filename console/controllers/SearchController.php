<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 06.09.17
 * Time: 17:21
 */

namespace console\controllers;


use core\entities\Shop\Product\CategoryAssignment;
use core\entities\Shop\Product\Product;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Elasticsearch\Common\Exceptions\Missing404Exception;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use core\entities\Shop\Category;
use core\entities\Shop\Product\Value;

class SearchController extends Controller
{
    private $client;

    public function __construct($id, $module, Client $client, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->client = $client;
    }

    public function actionReindex(): void
    {
        $query = Product::find()
            ->active()
            ->with(['category', 'categoryAssignments', 'tagAssignments', 'values'])
            ->orderBy('id');

        $this->stdout('Clearing' . PHP_EOL);

        try {
            $this->client->indices()->delete([
                'index' => 'shop'
            ]);
        } catch (Missing404Exception $e) {
            $this->stdout('Index is empty' . PHP_EOL);
        }

        $this->stdout('Creating of index' . PHP_EOL);

        //TODO need create different indexes like table - products_ru, products_ua and maybe products_en for multi language
        $this->client->indices()->create([
            'index' => 'shop',
            'body' => [
                'mappings' => [
                    'products' => [
                        '_source' => [
                            'enabled' => true,
                        ],
                        'properties' => [
                            'id' => [
                                'type' => 'integer',
                            ],
                            'name' => [
                                'type' => 'text',
                            ],
                            'description' => [
                                'type' => 'text',
                            ],
                            'price' => [
                                'type' => 'integer',
                            ],
                            'rating' => [
                                'type' => 'float',
                            ],
                            'brand' => [
                                'type' => 'integer',
                            ],
                            'categories' => [
                                'type' => 'integer',
                            ],
                            'tags' => [
                                'type' => 'integer',
                            ],
                            'values' => [
                                'type' => 'nested',
                                'properties' => [
                                    'characteristic' => [
                                        'type' => 'integer'
                                    ],
                                    'value_string' => [
                                        'type' => 'keyword',
                                    ],
                                    'value_int' => [
                                        'type' => 'integer',
                                    ],
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]);

        $this->stdout('Indexing of products' . PHP_EOL);

        foreach ($query->each() as $product) {
            /** @var Product $product */
            $this->stdout('Product #' . $product->id . PHP_EOL);

            $this->client->index([
                'index' => 'shop',
                'type' => 'products',
                'id' => $product->id,
                'body' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'description' => strip_tags($product->description),
                    'price' => $product->price_new,
                    'rating' => $product->rating,
                    'brand' => $product->brand_id,
                    'categories' => ArrayHelper::merge(
                        [$product->category->id],
                        ArrayHelper::getColumn($product->category->parents, 'id'),
                        ArrayHelper::getColumn($product->categoryAssignments, 'category_id'),

                        array_reduce(array_map(function () {
                            $category = new Category();
                            return ArrayHelper::getColumn($category->parents, 'id');
                        }, $product->categoryAssignments),'array_merge', [])

                    ),
                    'tags' => ArrayHelper::getColumn($product->tagAssignments, 'tag_id'),
                    'values' => array_map(function (Value $value) {
                        return [
                            'characteristic' => $value->characteristic_id,
                            'value_string' => (string)$value->value,
                            'value_int' => (int)$value->value,
                        ];
                    }, $product->values),
                ],
            ]);
        }

        $this->stdout('Done!' . PHP_EOL);
    }
}
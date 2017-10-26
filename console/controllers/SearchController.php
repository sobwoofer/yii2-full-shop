<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 06.09.17
 * Time: 17:21
 */
namespace console\controllers;

use core\entities\Shop\Product\Product;
use core\services\search\ProductIndexer;
use yii\console\Controller;

class SearchController extends Controller
{
    private $indexer;

    public function __construct($id, $module, ProductIndexer $indexer, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->indexer = $indexer;
    }

    public function actionReindex(): void
    {
        $query = Product::find()
            ->active()
            ->with(['category', 'categoryAssignments', 'tagAssignments', 'values'])
            ->orderBy('id');

        $this->stdout('Clearing' . PHP_EOL);

        $this->indexer->clear();

        $this->stdout('Indexing of products' . PHP_EOL);

        foreach ($query->each() as $product) {
            /** @var Product $product */
            $this->stdout('Product #' . $product->id . PHP_EOL);
            $this->indexer->index($product);
        }

        $this->stdout('Done!' . PHP_EOL);
    }
}
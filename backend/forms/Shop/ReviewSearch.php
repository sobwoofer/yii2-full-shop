<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 06.11.17
 * Time: 11:40
 */

namespace backend\forms\Shop;

use yii\base\Model;
use core\entities\Shop\Product\Review;
use yii\data\ActiveDataProvider;
use Yii;

class ReviewSearch extends Model
{
    public $id;
    public $created_at;
    public $text;
    public $active;
    public $product_id;

    public function rules(): array
    {
        return [
            [['id', 'product_id', 'created_at'], 'integer'],
            [['text'], 'safe'],
            [['active'], 'boolean'],
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Review::find()->with(['product']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'key' => function (Review $review) {
                return [
                    'product_id' => $review->product_id,
                    'id' => $review->id,
                ];
            },
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
        ]);

        $query
            ->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }

    public function activeList(): array
    {
        return [
            1 => Yii::$app->formatter->asBoolean(true),
            0 => Yii::$app->formatter->asBoolean(false),
        ];
    }

}
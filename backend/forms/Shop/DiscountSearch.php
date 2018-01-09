<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 09.01.18
 * Time: 16:57
 */

namespace backend\forms\Shop;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use core\entities\Shop\Discount;

class DiscountSearch extends Model
{
    public $id;
    public $name;
    public $percent;
    public $active;
    public $fromDate;
    public $toDate;
    public $slug;

    public function rules(): array
    {
        return [
            [['id', 'percent', 'active'], 'integer'],
            [['name', 'fromDate', 'toDate'], 'safe'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Discount::find()->joinWith('translation');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_ASC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;

    }
}
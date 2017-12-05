<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 23.08.17
 * Time: 10:41
 */

namespace backend\forms\Shop;


use core\entities\Shop\Brand\Brand;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class BrandSearch extends Model
{
    public $id;
    public $name;
    public $slug;

    public function rules(): array
    {
        return [
            [['id'], 'integer'],
            [['name', 'slug'], 'safe'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Brand::find()->localized();
//        var_dump($query->orderBy('name')->all());
//        die();
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

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;

    }

}
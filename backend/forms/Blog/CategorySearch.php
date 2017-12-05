<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 15.09.17
 * Time: 14:12
 */

namespace backend\forms\Blog;


use core\entities\Blog\Category;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CategorySearch extends Model
{
    public $id;
    public $name;
    public $slug;
    public $title;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'slug', 'title'], 'safe']
        ];
    }

    public function search(array $params): ActiveDataProvider
    {
        $query = Category::find()->joinWith('translations');;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['sort' => SORT_ASC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;

    }

}
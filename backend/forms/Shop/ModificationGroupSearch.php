<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 16:09
 */

namespace backend\forms\Shop;


use core\entities\Shop\Modification\ModificationGroup;
use core\helpers\ModificationGroupHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ModificationGroupSearch extends Model
{
    public $id;
    public $name;
    public $slug;
    public $status;

    public function rules(): array
    {
        return [
            [['id', 'status'], 'integer'],
            [['name', 'slug'], 'string'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = ModificationGroup::find()->joinWith('translation');

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
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;

    }


    public function statusList()
    {
        return ModificationGroupHelper::statusList();
    }

}
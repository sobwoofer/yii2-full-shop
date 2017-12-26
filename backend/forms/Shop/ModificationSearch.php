<?php
/**
 * Created by PhpStorm.
 * User: volynets
 * Date: 21.12.17
 * Time: 16:09
 */

namespace backend\forms\Shop;


use core\entities\Shop\Modification\Modification;
use core\entities\Shop\Modification\ModificationGroup;
use core\helpers\ModificationHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class ModificationSearch extends Model
{
    public $id;
    public $name;
    public $group_id;

    public function rules(): array
    {
        return [
            [['id', 'group_id'], 'integer'],
            ['name', 'string'],
        ];
    }

    /**
     * @param array $params
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Modification::find()->joinWith('translation');

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

    public function groupList()
    {
        return ArrayHelper::map(ModificationGroup::find()->localized()->all(), 'id', 'name');
    }

    public function statusList()
    {
        return ModificationHelper::statusList();
    }

}
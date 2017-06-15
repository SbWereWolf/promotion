<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TagAccount;

/**
 * TagAccountSearch represents the model behind the search form about `backend\models\TagAccount`.
 */
class TagAccountSearch extends TagAccount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tag_id', 'account_id'], 'integer'],
            [['insert_date'], 'safe'],
            [['is_hidden'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TagAccount::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'insert_date' => $this->insert_date,
            'is_hidden' => $this->is_hidden,
            'tag_id' => $this->tag_id,
            'account_id' => $this->account_id,
        ]);

        return $dataProvider;
    }
}

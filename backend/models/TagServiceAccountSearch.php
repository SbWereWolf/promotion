<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TagServiceAccount;

/**
 * TagServiceAccountSearch represents the model behind the search form about `backend\models\TagServiceAccount`.
 */
class TagServiceAccountSearch extends TagServiceAccount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tag_id', 'service_account_id'], 'integer'],
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
        $query = TagServiceAccount::find();

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
            'service_account_id' => $this->service_account_id,
        ]);

        return $dataProvider;
    }
}

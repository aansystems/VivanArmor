<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Learners;

/**
 * LearnersSearch represents the model behind the search form of `frontend\models\Learners`.
 */
class LearnersSearch extends Learners
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'address_id', 'payment_type', 'created_by', 'updated_by'], 'integer'],
            [['alternate_email', 'alternate_phone', 'remarks', 'created_at', 'updated_at'], 'safe'],
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
        $query = Learners::find()
                ->OrderBy(['id'=>SORT_DESC]);

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
            'user_id' => $this->user_id,
            'address_id' => $this->address_id,
            'payment_type' => $this->payment_type,
            'created_at' => $this->created_at,
             'status' => 10,
            'created_by' => Yii::$app->user->identity->id,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'alternate_email', $this->alternate_email])
            ->andFilterWhere(['like', 'alternate_phone', $this->alternate_phone])
            
            ->andFilterWhere(['like', 'remarks', $this->remarks]);

        return $dataProvider;
    }
}

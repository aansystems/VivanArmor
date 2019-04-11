<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ReviewMaterialScoring;

/**
 * ReviewMaterialScoringSearch represents the model behind the search form of `frontend\models\ReviewMaterialScoring`.
 */
class ReviewMaterialScoringSearch extends ReviewMaterialScoring
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'learner_id', 'review_material_id', 'created_by'], 'integer'],
            [['answer', 'created_at'], 'safe'],
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
        $query = ReviewMaterialScoring::find();

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
            'learner_id' => $this->learner_id,
            'review_material_id' => $this->review_material_id,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'answer', $this->answer]);

        return $dataProvider;
    }
}

<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ReviewMaterial;

/**
 * ReviewMaterialSearch represents the model behind the search form of `frontend\models\ReviewMaterial`.
 */
class ReviewMaterialSearch extends ReviewMaterial
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['id', 'course_id'], 'integer'],
          [['review_material_type', 'description', 'answer1', 'answer2', 'correct_answer', 'link'], 'safe'],
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
        $query = ReviewMaterial::find();

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
            'course_id' => $this->course_id,
        ]);

        $query->andFilterWhere(['like', 'review_material_type', $this->review_material_type])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'answer1', $this->answer1])
            ->andFilterWhere(['like', 'answer2', $this->answer2])
            ->andFilterWhere(['like', 'correct_answer', $this->correct_answer])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}

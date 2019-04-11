<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\LearnerActivity;

/**
 * LearnerActivitySearch represents the model behind the search form of `frontend\models\LearnerActivity`.
 */
class LearnerActivitySearch extends LearnerActivity
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'learner_id', 'lesson_id', 'section_id', 'current_slide_no', 'total_slides', 'completion_status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
        $query = LearnerActivity::find();

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
            'lesson_id' => $this->lesson_id,
            'section_id' => $this->section_id,
            'current_slide_no' => $this->current_slide_no,
            'total_slides' => $this->total_slides,
            'completion_status' => $this->completion_status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}

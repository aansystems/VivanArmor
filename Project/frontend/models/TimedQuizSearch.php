<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TimedQuiz;

/**
 * TimedQuizSearch represents the model behind the search form of `frontend\models\TimedQuiz`.
 */
class TimedQuizSearch extends TimedQuiz
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'subject', 'created_by'], 'integer'],
            [['question', 'options', 'right_answer', 'created_at'], 'safe'],
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
        $query = TimedQuiz::find();

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
            'subject' => $this->subject,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'question', $this->question])
            ->andFilterWhere(['like', 'options', $this->options])
            ->andFilterWhere(['like', 'right_answer', $this->right_answer]);

        return $dataProvider;
    }
}

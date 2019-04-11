<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\HomeScreenMessages;

/**
 * HomeScreenMessagesSearch represents the model behind the search form of `frontend\models\HomeScreenMessages`.
 */
class HomeScreenMessagesSearch extends HomeScreenMessages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by'], 'integer'],
            [['content','title','attachment','start_date', 'end_date','assigned_to'], 'safe'],
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
        
        $query = HomeScreenMessages::find();

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
            'title'=>$this->title,
            'created_by' => Yii::$app->user->identity->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
              ->andFilterWhere(['like', 'title', $this->title])
              ->andFilterWhere(['like', 'attachment', $this->attachment]);
        return $dataProvider;
    }
}

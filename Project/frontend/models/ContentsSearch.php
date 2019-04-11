<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Contents;

/**
 * ContentsSearch represents the model behind the search form of `frontend\models\Contents`.
 */
class ContentsSearch extends Contents
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['content_name', 'content_description','content_type', 'author_name', 'author_comment', 'file_name', 'expiry_date', 'created_at', 'updated_at'], 'safe'],
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
        $query = Contents::find();

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
            'user_id' =>Yii::$app->user->identity->id,
            'expiry_date' => $this->expiry_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'content_name', $this->content_name])
            ->andFilterWhere(['like', 'content_description', $this->content_description])
            ->andFilterWhere(['like', 'author_name', $this->author_name])
            ->andFilterWhere(['like', 'author_comment', $this->author_comment])
            //->andFilterWhere(['like', 'content_type', $this->content_type])
            ->andFilterWhere(['like', 'file_name', $this->file_name]);

        return $dataProvider;
    }
}

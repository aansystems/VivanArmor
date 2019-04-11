<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Documents;

/**
 * DocumentsSearch represents the model behind the search form of `frontend\models\Documents`.
 */
class DocumentsSearch extends Documents
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'template_id','user_id','status'], 'integer'],
            [['document_name', 'document_type', 'document_description', 'file_name', 'folder_name'], 'safe'],
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
        $id= Yii::$app->user->identity->id;
        $query = Documents::find();

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
            'template_id' => $this->template_id,
        ]);

        $query->andFilterWhere(['like', 'document_name', $this->document_name])
            ->andFilterWhere(['like', 'document_type', $this->document_type])
            ->andFilterWhere(['like', 'document_description', $this->document_description])
            ->andFilterWhere(['like', 'file_name', $this->file_name])
            ->andFilterWhere(['like', 'folder_name', $this->folder_name])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'user_id', $this->user_id]);
        

        return $dataProvider;
    }
}

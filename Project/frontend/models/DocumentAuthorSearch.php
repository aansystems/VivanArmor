<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\DocumentAuthor;

/**
 * DocumentAuthorSearch represents the model behind the search form of `frontend\models\DocumentAuthor`.
 */
class DocumentAuthorSearch extends DocumentAuthor {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id','document_id', 'assigned_to', 're-assigned_to'], 'integer'],
            [['author_name', 'autor_comment', 'workflow_expiry_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = DocumentAuthor::find();

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
            'document_id' => $this->document_id,
            'assigned_to' => $this->assigned_to,
            're-assigned_to' => $this->re - assigned_to,
            'workflow_expiry_date' => $this->workflow_expiry_date,
        ]);

        $query->andFilterWhere(['like', 'author_name', $this->author_name])         
                ->andFilterWhere(['like', 'autor_comment', $this->autor_comment]);

        return $dataProvider;
    }

}

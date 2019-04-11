<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\AssignedTemplates;

/**
 * AssignedTemplatesSearch represents the model behind the search form of `frontend\models\AssignedTemplates`.
 */
class AssignedTemplatesSearch extends AssignedTemplates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'master_doc_temp_id', 'assigned_to'], 'integer'],
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
        
                 $request = Yii::$app->request;
        	$master_doc_temp_id = $request->get('id');

        $query = AssignedTemplates::find();

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
            'master_doc_temp_id' => $this->master_doc_temp_id,
            'assigned_to' => $this->assigned_to,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}

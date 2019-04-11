<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\License;

/**
 * LicenseSearch represents the model behind the search form of `frontend\models\License`.
 */
class LicenseSearch extends License
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'subscription_type'], 'integer'],
            [['license_issued', 'license_expired', 'renewal_date', 'renewal_purpose'], 'safe'],
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
        $query = License::find()
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
            'company_id' => $this->company_id,
            'subscription_type' => $this->subscription_type,
         
            'license_issued' => $this->license_issued,
            'license_expired' => $this->license_expired,
            'renewal_date' => $this->renewal_date,
        ]);

        $query->andFilterWhere(['like', 'renewal_purpose', $this->renewal_purpose]);

        return $dataProvider;
    }
}

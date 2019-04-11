<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SuperAdminNotifications;

/**
 * SuperAdminNotificationsSearch represents the model behind the search form of `frontend\models\SuperAdminNotifications`.
 */
class SuperAdminNotificationsSearch extends SuperAdminNotifications
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'assigned_from', 'assigned_to', 'created_by', 'updated_by'], 'integer'],
            [['message', 'start_date', 'end_date', 'created_at', 'updated_at'], 'safe'],
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
        $query = SuperAdminNotifications::find()->OrderBy(['id'=>SORT_DESC]);;

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
            'assigned_from' => $this->assigned_from,
            'assigned_to' => $this->assigned_to,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'created_by' =>Yii::$app->user->identity->id,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}

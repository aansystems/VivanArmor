<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\UploadedCertificates;

/**
 * UploadedCertificatesSearch represents the model behind the search form of `frontend\models\UploadedCertificates`.
 */
class UploadedCertificatesSearch extends UploadedCertificates {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'learner_id'], 'integer'],
            [['certificate_name', 'certifying_authority', 'issue_date', 'expire_date', 'certificate_no', 'attachment'], 'safe'],
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

        $id = Yii::$app->user->identity->id;
        $learner_id = Learners::find()->where(['user_id' => $id])->one();
        $query = UploadedCertificates::find()->where(['learner_id' => $learner_id]);

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
            'issue_date' => $this->issue_date,
            'expire_date' => $this->expire_date,
        ]);

        $query->andFilterWhere(['like', 'certificate_name', $this->certificate_name])
                ->andFilterWhere(['like', 'certifying_authority', $this->certifying_authority])
                ->andFilterWhere(['like', 'certificate_no', $this->certificate_no])
                ->andFilterWhere(['like', 'attachment', $this->attachment]);

        return $dataProvider;
    }

}

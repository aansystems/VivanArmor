<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Certificates;


/**
 * CertificatesSearch represents the model behind the search form of `frontend\models\Certificates`.
 */
class CertificatesSearch extends Certificates {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'learner_id', 'status'], 'integer'],
            [['certificate_name', 'certifying_authority', 'issue_date', 'expire_date', 'certificate_no'], 'safe'],
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
        $id= Yii::$app->user->identity->id;
        $learner_id = Learners::find()->where(['user_id' => $id])->one();

//
//         $query6 = " SELECT *
//   FROM certificates
//   WHERE certificates.learner_id =" . $learner_id->id . "
//   UNION ALL
//   SELECT *
//   FROM uploaded_certificates
//   WHERE uploaded_certificates.learner_id=" . $learner_id->id . ";";
//        $connection6 = Yii::$app->db;
//        $command6 = $connection6->createCommand($query6);
//        echo '<pre/>';print_r($command6);die();

        
        $query = Certificates::find()->where(['learner_id' => $learner_id]);

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
                ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }

}

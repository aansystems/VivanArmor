<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "certificates".
 *
 * @property int $id
 * @property int $learner_id
 * @property string $certificate_name
 * @property string $certifying_authority
 * @property string $issue_date
 * @property string $expire_date
 * @property string $certificate
 * @property string $status
 *
 * @property Learners $learner
 */
class Certificates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'certificates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'learner_id', 'certificate_name', 'certifying_authority', 'issue_date', 'expire_date', 'certificate_no', 'status'], 'required'],
            [['id', 'learner_id', 'status'], 'integer'],
            [['issue_date', 'expire_date'], 'safe'],
            [['certificate'], 'string'],
            [['certificate_name', 'certifying_authority'], 'string', 'max' => 255],
            [['learner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Learners::className(), 'targetAttribute' => ['learner_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'learner_id' => 'Learner ID',
            'certificate_name' => 'Certificate Name',
            'certifying_authority' => 'Certifying Authority',
            'issue_date' => 'Issue Date',
            'expire_date' => 'Expire Date',
            'certificate_no' => 'Certificate No',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearner()
    {
        return $this->hasOne(Learners::className(), ['id' => 'learner_id']);
    }
}

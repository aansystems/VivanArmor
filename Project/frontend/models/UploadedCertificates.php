<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "uploaded_certificates".
 *
 * @property int $id
 * @property int $learner_id
 * @property string $certificate_name
 * @property string $certifying_authority
 * @property string $issue_date
 * @property string $expire_date
 * @property string $certificate_no
 * @property string $link
 *
 * @property Learners $learner
 */
class UploadedCertificates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;
    public static function tableName()
    {
        return 'uploaded_certificates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['learner_id', 'certificate_name', 'certifying_authority','file', 'issue_date', 'expire_date', 'certificate_no', 'attachment'], 'required'],
            [['learner_id'], 'integer'],
            [['issue_date', 'expire_date'], 'safe'],
            [['attachment'], 'string'],
            [['file'],'file'],
            [['certificate_name', 'certifying_authority', 'certificate_no'], 'string', 'max' => 255],
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
            'file' => 'Attachment',
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

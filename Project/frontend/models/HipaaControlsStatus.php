<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "hipaa_controls_status".
 *
 * @property int $id
 * @property int $company_id
 * @property int $policy_id
 * @property int $policy_option_id
 * @property string $file
 * @property string $expiry_date
 * @property string $created_at
 * @property int $created_by
 *
 * @property Company $company
 * @property User $createdBy
 * @property MasterHipaaControl $policy
 * @property MasterCsoControlOptions $policyOption
 */
class HipaaControlsStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hipaa_controls_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'policy_id', 'policy_option_id', 'created_by'], 'required'],
            [['company_id', 'policy_id', 'policy_option_id', 'created_by'], 'integer'],
            [['expiry_date', 'created_at'], 'safe'],
            [['file'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['policy_id'], 'exist', 'skipOnError' => true, 'targetClass' => MasterHipaaControl::className(), 'targetAttribute' => ['policy_id' => 'id']],
            [['policy_option_id'], 'exist', 'skipOnError' => true, 'targetClass' => MasterCsoControlOptions::className(), 'targetAttribute' => ['policy_option_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'policy_id' => 'Policy ID',
            'policy_option_id' => 'Policy Option ID',
            'file' => 'File',
            'expiry_date' => 'Expiry Date',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolicy()
    {
        return $this->hasOne(MasterHipaaControl::className(), ['id' => 'policy_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolicyOption()
    {
        return $this->hasOne(MasterCsoControlOptions::className(), ['id' => 'policy_option_id']);
    }

    /**
     * @inheritdoc
     * @return HipaaControlsStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HipaaControlsStatusQuery(get_called_class());
    }
}

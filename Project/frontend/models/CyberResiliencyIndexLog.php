<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cyber_resiliency_index_log".
 *
 * @property int $id
 * @property int $company_id
 * @property double $resiliency_index
 * @property double $learning_index
 * @property double $process_index
 * @property double $technical_index
 * @property string $log_date
 *
 * @property Company $company
 */
class CyberResiliencyIndexLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cyber_resiliency_index_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'resiliency_index', 'learning_index', 'process_index', 'technical_index'], 'required'],
            [['company_id'], 'integer'],
            [['resiliency_index', 'learning_index', 'process_index', 'technical_index'], 'number'],
            [['log_date'], 'safe'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
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
            'resiliency_index' => 'Resiliency Index',
            'learning_index' => 'Learning Index',
            'process_index' => 'Process Index',
            'technical_index' => 'Technical Index',
            'log_date' => 'Log Date',
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
     * @inheritdoc
     * @return CyberResiliencyIndexLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CyberResiliencyIndexLogQuery(get_called_class());
    }
}

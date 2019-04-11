<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "assigned_templates".
 *
 * @property int $id
 * @property int $master_doc_temp_id
 * @property int $assigned_to
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MasterDocTemplates $masterDocTemp
 */
class AssignedTemplates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'assigned_templates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['master_doc_temp_id', 'assigned_to', 'created_at', 'updated_at'], 'required'],
            [['master_doc_temp_id', 'assigned_to'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['master_doc_temp_id'], 'exist', 'skipOnError' => true, 'targetClass' => MasterDocTemplates::className(), 'targetAttribute' => ['master_doc_temp_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'master_doc_temp_id' => 'Master Doc Temp ID',
            'assigned_to' => 'Assigned To',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasterDocTemp()
    {
        return $this->hasOne(MasterDocTemplates::className(), ['id' => 'master_doc_temp_id']);
    }
}

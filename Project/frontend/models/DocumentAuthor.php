<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "document_author".
 *
 * @property int $id
 * @property int $document_id
 * @property int $assigned_to
 * @property string $workflow_expiry_date
 *
 * @property User $assignedTo
 */
class DocumentAuthor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document_author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['document_id', 'workflow_expiry_date'], 'required'],
            [['document_id', 'assigned_to'], 'integer'],
            [['workflow_expiry_date'], 'safe'],
            [['assigned_to'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['assigned_to' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'document_id' => 'Document ID',
            'assigned_to' => 'Assigned To',
            'workflow_expiry_date' => 'Workflow Expiry Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedTo()
    {
        return $this->hasOne(User::className(), ['id' => 'assigned_to']);
    }
}

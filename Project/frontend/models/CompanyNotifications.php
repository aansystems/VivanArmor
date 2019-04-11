<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "company_notifications".
 *
 * @property int $id
 * @property int $assigned_from
 * @property int $assigned_to
 * @property string $message
 * @property string $start_date
 * @property string $end_date
 * @property int $created_by
 * @property string $created_at
 * @property int $updated_by
 * @property string $updated_at
 *
 * @property User $assignedFrom
 * @property User $assignedTo
 * @property User $createdBy
 * @property User $updatedBy
 */
class CompanyNotifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['assigned_from', 'assigned_to', 'message', 'start_date', 'end_date', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['assigned_from', 'assigned_to', 'created_by', 'updated_by'], 'integer'],
            [['message'], 'string'],
            [['start_date', 'end_date', 'created_at', 'updated_at'], 'safe'],
            [['assigned_from'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['assigned_from' => 'id']],
            [['assigned_to'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['assigned_to' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'assigned_from' => 'Select Role',
            'assigned_to' => 'Select User',
            'message' => 'Message',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedFrom()
    {
        return $this->hasOne(User::className(), ['id' => 'assigned_from']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedTo()
    {
        return $this->hasOne(User::className(), ['id' => 'assigned_to']);
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
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}

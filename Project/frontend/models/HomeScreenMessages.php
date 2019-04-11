<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "home_screen_messages".
 *
 * @property int $id
 * @property string $assigned_to
 * @property string $title
 * @property string $content
 * @property string $attachment
 * @property string $start_date
 * @property string $end_date
 * @property int $created_by
 *
 * @property User $createdBy
 */
class HomeScreenMessages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'home_screen_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['assigned_to', 'title', 'content', 'start_date', 'end_date', 'created_by'], 'required'],
            [['content'], 'string'],
            [['start_date', 'end_date','assigned_to','created_by'], 'safe'],
            [['title', 'attachment'], 'string', 'max' => 200],
            //[['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'assigned_to' => 'Assigned To',
            'title' => 'Title',
            'content' => 'Content',
            'attachment' => 'Attachment',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'created_by' => 'Created By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}

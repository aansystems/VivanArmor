<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "bigbluebutton_calendar_meetings".
 *
 * @property int $id
 * @property string $meeting_id
 * @property string $meeting_name
 * @property string $date_time_scheduled
 * @property string $description
 * @property string $participants
 * @property string $created_date
 */
class BigbluebuttonCalendarMeetings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bigbluebutton_calendar_meetings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meeting_id', 'meeting_name', 'date_time_scheduled', 'description', 'participants', 'created_date'], 'required'],
            [['date_time_scheduled', 'created_date'], 'safe'],
            [['description', 'participants'], 'string'],
            [['meeting_id'], 'string', 'max' => 65],
            [['meeting_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'meeting_id' => 'Meeting ID',
            'meeting_name' => 'Meeting Name',
            'date_time_scheduled' => 'Date Time Scheduled',
            'description' => 'Description',
            'participants' => 'Participants',
            'created_date' => 'Created Date',
        ];
    }
}

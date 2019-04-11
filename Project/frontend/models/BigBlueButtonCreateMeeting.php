<?php

namespace frontend\models;

use Yii;

class BigBlueButtonCreateMeeting extends \yii\base\Model {

    public $meeting_name;
    public $attendee_password;
    public $moderator_password;
    public $duration;
    public $record;
    public $description;
    public $participants;
    public $datetime;
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['meeting_id', 'meeting_name', 'attendee_password', 'moderator_password','participants','datetime'], 'required'],
                [['duration', 'record'], 'integer'],
                   [['datetime'], 'safe'],
                [['meeting_id', 'meeting_name', 'attendee_password', 'moderator_password', 'description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'meeting_id' => 'Meeting ID',
            'meeting_name' => 'Meeting Name',
            'attendee_password' => 'Attendee Password',
            'moderator_password' => 'Moderator Password',
            'duration' => 'Duration',
            'record' => 'Enable recording for this Webinar',
            'participants' => 'participants',
            'datetime' => 'Time'
            ];
    }

}

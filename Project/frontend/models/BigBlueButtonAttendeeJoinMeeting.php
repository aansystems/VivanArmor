<?php

namespace frontend\models;

use Yii;

class BigBlueButtonAttendeeJoinMeeting extends \yii\base\Model {


    public $name;
    public $attendee_password;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['name', 'attendee_password'], 'required'],
                [['name','attendee_password'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [

            'name'=>'User Name',
            'attendee_password'=>'Attendee Password'
        ];
    }

}

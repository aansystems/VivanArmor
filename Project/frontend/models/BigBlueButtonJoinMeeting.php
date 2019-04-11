<?php

namespace frontend\models;

use Yii;

class BigBlueButtonJoinMeeting extends \yii\base\Model {

    public $name;
    public $moderator_password;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['name', 'moderator_password'], 'required'],
                [['name', 'moderator_password'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'name' => 'Participant Name',
            'moderator_password' => 'Moderator Password'
        ];
    }

}

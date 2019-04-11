<?php

namespace frontend\controllers;

use Yii;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;
use BigBlueButton\Parameters\EndMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use BigBlueButton\Parameters\GetRecordingsParameters;
use BigBlueButton\Parameters\DeleteRecordingsParameters;
use frontend\models\BigBlueButtonCreateMeeting;
use frontend\models\BigBlueButtonJoinMeeting;
use frontend\models\BigBlueButtonAttendeeJoinMeeting;
use yii\filters\VerbFilter;
use frontend\models\User;

class BigBlueButtonController extends \yii\web\Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['create-meeting', 'get-meetings', 'get-recordings','display-recordings'],
                'rules' => [
                    // allow authenticated users
                        [
                        'allow' => true,
                        'roles' => ['@'],
                                                    'matchCallback' => function ($rule, $action) {
                            return User::findOne(['id' => Yii::$app->user->identity->id])->two_fact === 1;
                        },
                    ],
                // everything else is denied
                ],
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionCreateMeeting() {
        $model = new BigBlueButtonCreateMeeting();


        if ($model->load(Yii::$app->request->post())) {

            $bbb = new BigBlueButton();

            function getGUID() {
                if (function_exists('com_create_guid')) {
                    return com_create_guid();
                } else {
                    mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
                    $charid = strtoupper(md5(uniqid(rand(), true)));
                    $hyphen = chr(45); // "-"
                    $uuid = chr(123)// "{"
                            . substr($charid, 0, 8) . $hyphen
                            . substr($charid, 8, 4) . $hyphen
                            . substr($charid, 12, 4) . $hyphen
                            . substr($charid, 16, 4) . $hyphen
                            . substr($charid, 20, 12)
                            . chr(125); // "}"
                    return $uuid;
                }
            }

            $GUID = getGUID();
            $meeting_id = trim($GUID, '{}');

            $url_logout = Yii::$app->request->baseUrl;

            if ($model->record == 1) {
                $record_status = true;
            } elseif ($model->record == 0) {
                $record_status = false;
            }

            $createMeetingParams = new CreateMeetingParameters($meeting_id, $model->meeting_name);
            $createMeetingParams->setAttendeePassword($model->attendee_password);
            $createMeetingParams->setModeratorPassword($model->moderator_password);
            $createMeetingParams->setDuration($model->duration);
            $createMeetingParams->setLogoutUrl($url_logout);
            $attendee_password = $model->attendee_password;
            $createMeetingParams->setRecord($record_status);
            $createMeetingParams->setAllowStartStopRecording($record_status);
            $createMeetingParams->setAutoStartRecording($record_status);
            $number_of_participants = sizeof($model->participants);
            $datetime = $model->datetime;
            for ($i = 0; $i < $number_of_participants; $i++) {
                Yii::$app->mailer->compose(['html' => 'login-class-html'], ['meeting_id' => $meeting_id, 'attendee_password' => $attendee_password, 'datetime' => $datetime])
                        ->setFrom('vivaanlms@aansystems.com')
                        ->setTo($model->participants[$i])
                        ->setSubject('link to class')
                        ->send();
            }

            $response = $bbb->createMeeting($createMeetingParams);
            
            if ($response->getReturnCode() == 'FAILED') {
                return 'Can\'t create room! please contact our administrator.';
            } else {
                // process after room created
            }

            /* Creating Calendar Meetings START */

            $participants = implode(",", $model->participants);
            $connection = Yii::$app->db;
            $connection->createCommand()->insert('bigbluebutton_calendar_meetings', [
                        'meeting_id' => $meeting_id,
                        'meeting_name' => $model->meeting_name,
                        'date_time_scheduled' => date('Y-m-d h:i:s', strtotime($datetime)),
                        'description' => $model->description,
                        'participants' => $participants,
                        'created_date' => date('Y-m-d h:i:s')
                    ])
                    ->execute();

            return $this->redirect(['get-meetings']);
        } else {
            return $this->render('create-meeting', [
                        'model' => $model,
            ]);
        }
    }

    public function actionGetMeetings() {
        $bbb = new BigBlueButton();
        $response = $bbb->getMeetings();
        return $this->render('get-meetings', [
                    'response' => $response
        ]);
    }

    public function actionJoinMeeting($meeting_id) {
        $model = new BigBlueButtonJoinMeeting();

        if ($model->load(Yii::$app->request->post())) {
            $bbb = new BigBlueButton();

            $meetingID = $meeting_id;
            $name = $model->name;
            $password = $model->moderator_password;

            $joinMeetingParams = new JoinMeetingParameters($meetingID, $name, $password); // $moderator_password for moderator
            $joinMeetingParams->setRedirect(true);
            $url = $bbb->getJoinMeetingURL($joinMeetingParams);

            return $this->render('meeting-display-screen', [
                        'url' => $url,
            ]);
        } else {
            return $this->renderAjax('join-meeting', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAttendeeJoinMeeting($meeting_id) {
        $model = new BigBlueButtonAttendeeJoinMeeting();
        if ($model->load(Yii::$app->request->post())) {
            $bbb = new BigBlueButton();

            $meetingID = $meeting_id;
            $name = $model->name;
            $password = $model->attendee_password;

            $joinMeetingParams = new JoinMeetingParameters($meetingID, $name, $password); // $attendee_password for attendee           
            $joinMeetingParams->setRedirect(true);
            $url = $bbb->getJoinMeetingURL($joinMeetingParams);

            return $this->render('meeting-display-screen', [
                        'url' => $url,
            ]);
        } else {

            return $this->render('attendee-join-meeting', [
                        'model' => $model,
            ]);
        }
    }

    public function actionDisplayRecordings($recording_id) {

        $recordingParams = new GetRecordingsParameters();
        $bbb = new BigBlueButton();
        $response = $bbb->getRecordings($recordingParams);
        $url = 'https://bigbluebutton.vivaanlms.com/playback/presentation/2.0/playback.html?meetingId=' . $recording_id;

        return $this->render('display-recordings', [
                    'url' => $url,
        ]);
    }

    public function actionCloseMeeting($meeting_id, $moderator_password) {
        $bbb = new BigBlueButton();

        $endMeetingParams = new EndMeetingParameters($meeting_id, $moderator_password);
        $response = $bbb->endMeeting($endMeetingParams);

        return $this->redirect(['site/index']);
    }

    public function actionGetMeetingInfo($meeting_id, $moderator_password) {
        $bbb = new BigBlueButton();
        $getMeetingInfoParams = new GetMeetingInfoParameters($meeting_id, '', $moderator_password);
        $response = $bbb->getMeetingInfo($getMeetingInfoParams);
        return $this->render('get-meeting-info', [
                    'response' => $response,
        ]);
    }

    public function actionGetRecordings() {
        $recordingParams = new GetRecordingsParameters();
        $bbb = new BigBlueButton();
        $response = $bbb->getRecordings($recordingParams);

        return $this->render('get-recordings', [
                    'response' => $response,
        ]);
    }

    public function actionDeleteMeeting($recording_id) {
        $bbb = new BigBlueButton();
        $deleteRecordingsParams = new DeleteRecordingsParameters($recording_id); // get from "Get Recordings"
        $response = $bbb->deleteRecordings($deleteRecordingsParams);

        if ($response->getReturnCode() == 'SUCCESS') {
            // recording deleted
        } else {
            // something wrong
        }

        return $this->redirect('get-recordings');
    }

}

<?php

namespace frontend\controllers;

use Yii;
use yii2fullcalendar\models\Event;
use frontend\models\BigbluebuttonCalendarMeetings;
use yii\filters\VerbFilter;
use frontend\models\User;

class MeetingsCalendarController extends \yii\web\Controller {

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                        'class' => \yii\filters\AccessControl::className(),
                        'only' => ['calendar-meeting-info','calendar'],
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
    
    public function actionCalendar() {
        $events = [];
        $calendar_meetings = BigbluebuttonCalendarMeetings::find()->all();

        foreach ($calendar_meetings as $meetings) :
            $event = new Event();
            $event->id = $meetings->id;
            $event->title = $meetings->meeting_name;
            $event->start = $meetings->date_time_scheduled;

            $current_date = strtotime(date('Y-m-d'));
            $meeting_date = strtotime(date('Y-m-d', strtotime($meetings->date_time_scheduled)));

            if ($current_date > $meeting_date) :
                $event->className = 'btn-danger';
            elseif ($current_date == $meeting_date) :
                $event->className = 'btn-success';
            elseif ($current_date < $meeting_date) :
                $event->className = 'btn-primarys';
            endif;
            $event->url = Yii::$app->request->baseUrl . '/meetings-calendar/calendar-meeting-info?id=' . $meetings->id;
            $events[] = $event;
        endforeach;

        return $this->render('calendar', [
                    'events' => $events
        ]);
    }

    public function actionCalendarMeetingInfo($id) {
        $meeting_details = BigbluebuttonCalendarMeetings::findOne(['id' => $id]);
        return $this->render('calendar-meeting-info', [
                    'meeting_details' => $meeting_details
        ]);
    }

}

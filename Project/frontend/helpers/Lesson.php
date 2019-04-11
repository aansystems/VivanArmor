<?php

namespace frontend\helpers;

use frontend\models\Courses;
use frontend\models\Lessons;
use frontend\models\Sections;

/**
 * This is the helper class for "Lessons".
 * Author : Chaithra Rao
 */
class Lesson {

    public static function accessCourseMaterials($course_id, $lesson_id, $section_id) {
        if ($course_id == 0 && $lesson_id == 0 && $section_id == 0) {
            $path = \Yii::$app->request->baseUrl . '/uploads/default/';   
            $dir_path = 'uploads/default';
        } else {
            $course_name = Courses::findOne(['id' => $course_id])->course_name;
            $lesson_name = Lessons::findOne(['id' => $lesson_id])->lesson_name;
            $folder_name = Sections::findOne(['id' => $section_id])->folder_name;
            $path = \Yii::$app->request->baseUrl . '/uploads/courses/' . $course_name . '/' . $lesson_name . '/' . $folder_name . '/';
            $dir_path = 'uploads/courses/' . $course_name . '/' . $lesson_name . '/' . $folder_name;
        }
        $extensions_array = ['jpg', 'png', 'jpeg', 'gif', 'html'];
        $files = scandir($dir_path);
        $total_slides = count($files) - 2;
        $unordered_files = [];
        if (is_dir($dir_path)) {
            for ($i = 1; $i < count($files); $i++) {
                if ($files[$i] != '.' && $files[$i] != '..') {
                    $unordered_files[$i] = $files[$i];
                }
            }
            natsort($unordered_files);
        }
        $access_parameters = ['unordered_files' => $unordered_files, 'path' => $path, 'total_slides' => $total_slides];
        return $access_parameters;
    }

}

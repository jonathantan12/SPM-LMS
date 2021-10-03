<?php
    require_once('common.php');

    $dao = new courseTrainersDAO();
    // Use this to pass in the course_id variable into the class function currently it is hard coded.
    // $course_id = $_GET["course_id"];
    $course_id = 1;

    $courseTrainers = $dao->getCourseTrainers($course_id);

    $items = [];
    foreach ( $courseTrainers as $aCourseTrainer ) {
        $item["course_trainer_id"] = $aCourseTrainer->getCourseTrainerId();  
        $item["course_id"] = $aCourseTrainer->getCourseId();
        $item["course_name"] = $aCourseTrainer->getCourseName();
        $item["user_id"] = $aCourseTrainer->getUserId();
        $item["user_name"] = $aCourseTrainer->getUserName();
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
    echo $postJSON;
?>
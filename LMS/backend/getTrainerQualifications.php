<?php
    require_once('common.php');
    $dao = new trainerQualificationsDAO();
    // Use this to pass in the user_id variable into the class function currently it is hard coded.
    // $user_id = $_GET["user_id"];
    $user_id = 2;

    $trainerQualifications = $dao->getTrainerQualifications($user_id);

    $items = [];
    foreach ( $trainerQualifications as $aTrainerQualifications ) {
        $item["trainer_qualifications_id"] = $aTrainerQualifications->getTrainerQualificationsId();
        $item["user_id"] = $aTrainerQualifications->getUserId();
        $item["user_name"] = $aTrainerQualifications->getUserName();
        $item["course_id"] = $aTrainerQualifications->getCourseId();
        $item["course_name"] = $aTrainerQualifications->getCourseName();
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
    echo $postJSON;

?>
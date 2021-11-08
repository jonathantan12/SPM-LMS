<?php
    require_once('common.php');

    $dao = new ClassesDAO();
    $classes = $dao->getClasses();

    $items = [];
    foreach ( $classes as $aClass ) {
        $item["course_id"] = $aClass->getCourseId();
        $item["course_name"] = $aClass->getCourseName();
        $item["class_name"] = $aClass->getClassName();
        $item["start_date"] = $aClass->getStartDate();
        $item["end_date"] = $aClass->getEndDate();
        $item["slots_available"] = $aClass->getSlotsAvailable();
        $item["trainer_id"] = $aClass->getTrainerId();
        $item["trainer_name"] = $aClass->getTrainerName();
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
    echo $postJSON;

?>
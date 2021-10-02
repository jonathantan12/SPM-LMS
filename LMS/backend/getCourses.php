<?php
    require_once('common.php');

    $dao = new coursesDAO();
    $courses = $dao->getCourses();

    $items = [];
    foreach ( $courses as $aCourse ) {
        $item["course_id"] = $aCourse->getCourseId();
        $item["course_name"] = $aCourse->getCourseName();
        $item["course_desc"] = $aCourse->getCourseDesc();
        $item["class_name"] = $aCourse->getClassName();
        $item["start_date"] = $aCourse->getStartDate();
        $item["end_date"] = $aCourse->getEndDate();
        $item["slots_available"] = $aCourse->getSlotsAvailable();
        $item["image"] = $aCourse->getImage();
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
    echo $postJSON;

?>
<?php
    require_once('CoursesDAO.php');

    $dao = new coursesDAO();
    $courses = $dao->getCourses();

    $items = [];
    foreach ( $courses as $aCourse ) {
        $item["course_id"] = $aCourse->getCourseId();
        $item["course_name"] = $aCourse->getCourseName();
        $item["course_desc"] = $aCourse->getCourseDesc();
        $item["image"] = $aCourse->getImage();
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
    echo $postJSON;

?>
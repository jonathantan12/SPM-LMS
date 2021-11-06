<?php
    require_once('common.php');

    $dao = new enrolledCoursesDAO();
    // Use this to pass in the user_id variable into the class function currently it is hard coded.
    // $user_id = $_GET["user_id"];
    $user_id = 1;
    $enrolledCourses = $dao->getEnrolledCourses($user_id);

    $items = [];
    foreach ( $enrolledCourses as $aEnrolledCourses ) {
        $item["enrolled_course_id"] = $aEnrolledCourses->getEnrolledCourseId();
        $item["user_id"] = $aEnrolledCourses->getUserId();
        $item["user_name"] = $aEnrolledCourses->getUserName();
        $item["course_id"] = $aEnrolledCourses->getCourseId();
        $item["course_name"] = $aEnrolledCourses->getCourseName();
        $item["class_name"] = $aEnrolledCourses->getClassName();
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
    echo $postJSON;
?>
<?php
    require_once('common.php');
    $dao = new completedCoursesDAO();
    // Use this to pass in the user_id variable into the class function currently it is hard coded.
    $user_id = 1;
    $completedCourses = $dao->getCompletedCourses($user_id);

    $items = [];
    foreach ( $completedCourses as $aCompletedCourse ) {
        $item["completed_course_id"] = $aCompletedCourse->getCompletedCourseId();
        $item["user_id"] = $aCompletedCourse->getUserId();
        $item["user_name"] = $aCompletedCourse->getUserName();
        $item["course_id"] = $aCompletedCourse->getCourseId();
        $item["course_name"] = $aCompletedCourse->getCourseName();
        $item["image"] = $aCompletedCourse->getImage();
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
    echo $postJSON;
    
?>
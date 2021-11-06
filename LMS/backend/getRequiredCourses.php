<?php
    require_once('common.php');

    $dao = new RequiredCoursesDAO();
    // Use this to pass in the user_id variable into the class function currently it is hard coded.
    // $user_id = $_GET["user_id"];
    $user_id = 1;
    $requiredCourses = $dao->getRequiredCourses($user_id);

    $items = [];
    foreach ( $requiredCourses as $requiredCourse ) {
        $item["required_course_id"] = $requiredCourse->getRequiredCourseId();
        $item["user_id"] = $requiredCourse->getUserId();
        $item["user_name"] = $requiredCourse->getUserName();
        $item["course_id"] = $requiredCourse->getCourseId();
        $item["course_name"] = $requiredCourse->getCourseName();
        $item["image"] = $requiredCourse->getImage();
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
    echo $postJSON;
?>
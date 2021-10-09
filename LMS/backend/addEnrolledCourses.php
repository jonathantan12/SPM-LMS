<?php
    require_once('common.php');
    $enrolledCoursesDAO = new enrolledCoursesDAO;
    $user_id = (int)$_GET['userId'];
    $user_name = $_GET['userName'];
    $course_id = (int)$_GET['courseId'];
    $course_name = $_GET['courseName'];
    
    $status = $enrolledCoursesDAO->addEnrolledCourses($user_id, $user_name, $course_id, $course_name);
    
    if($status){
        echo 'true';
    } else{
        echo 'false';
    }
?>
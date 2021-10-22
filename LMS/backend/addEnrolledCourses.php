<?php
    require_once('common.php');
    $enrolledCoursesDAO = new EnrolledCoursesDAO;
    $user_id = (int)$_GET['userId'];
    $user_name = $_GET['userName'];
    $course_id = (int)$_GET['courseId'];
    $course_name = $_GET['courseName'];
    $class_name = $_GET['className'];
    
    $status = $enrolledCoursesDAO->addEnrolledCourses($user_id, $user_name, $course_id, $course_name, $class_name);
    
    if($status){
        echo 'true';
    } else{
        echo 'false';
    }
?>
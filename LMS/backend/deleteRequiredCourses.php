<?php
    require_once('common.php');
    $requiredCoursesDAO = new requiredCoursesDAO;
    $user_id = (int)$_GET['userId'];
    $course_id = (int)$_GET['courseId'];
    
    $status = $requiredCoursesDAO->deleteRequiredCourse($user_id, $course_id);

    if($status){
        echo 'true';
    } else{
        echo 'false';
    }
?>
<?php
    require_once('common.php');
    $classesDAO = new ClassesDAO;
    $course_id = (int)$_GET['courseId'];
    $class_name = $_GET['className'];
    
    $status = $classesDAO->updateClassVacancy($course_id, $class_name);
    
    if($status){
        echo 'true';
    } else{
        echo 'false';
    }
?>
<?php
    require_once('common.php');
    $arr = json_decode($_POST['arr'],true);
    $dao = new quizzesDAO();
    $course_id = $arr[0];
    $course_class_id = $arr[1];
    $section_id = $arr[2];
    $quiz_id = (string)$arr[3];

    
    $status = $dao->deleteQuizzes($course_id, $course_class_id, $section_id, $quiz_id);

    if($status){
        print_r('true');
    } else{
        print_r('false');
    }
?>
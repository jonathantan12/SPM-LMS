<?php
    //connect to database to put these data in
    require_once('common.php');
    $arr = json_decode($_POST['arr'],true);
   
    $user_id = $arr[0];
    $course_id =$arr[1];
    $course_class_id = $arr[2];
    $section_id = $arr[3];
    $completion_status = $arr[4];

    $progress = new quizProgress($user_id, $course_id, $course_class_id, $section_id, $completion_status);
    $quizProgressDAO = new QuizProgressDAO;
    $result = $quizProgressDAO->update($progress);
    print_r($result);

    

?>
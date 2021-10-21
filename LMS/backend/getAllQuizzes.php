<?php
    require_once('common.php');
    $arr = json_decode($_POST['arr'],true);
    $dao = new quizzesDAO();
    // Use this to pass in the section_id variable into the class function currently it is hard coded.
    // $section_id = $_GET["section_id"];

    $course_id = $arr[0];
    $course_class_id = $arr[1];
    $section_id = $arr[2];
  
    $quizzes = $dao->retrieveAll($course_id,$course_class_id,$section_id);

    $items = [];
    foreach ( $quizzes as $aQuiz ) {
        $item["quiz_id"] = $aQuiz->getQuizId();
        $item["quiz_title"] = $aQuiz->getQuizTitle();  
        
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
   
    print_r ($postJSON);
?>
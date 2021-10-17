<?php
    require_once('common.php');
    $arr = json_decode($_POST['arr'],true);
    $dao = new quizzesDAO();
    // Use this to pass in the section_id variable into the class function currently it is hard coded.
    // $section_id = $_GET["section_id"];

    $course_id = $arr[0];
    $course_class_id = $arr[1];
    $section_id = $arr[2];
    $quiz_id = (string)$arr[3];

    $quizzes = $dao->getQuizzes($course_id,$course_class_id,$section_id,$quiz_id);

    $items = [];
    foreach ( $quizzes as $aQuiz ) {
        $item["quiz_title"] = $aQuiz->getQuizTitle();  
        $item["quiz_type"] = $aQuiz->getQuizType();
        $item["question_no"] = $aQuiz->getQuestionNo();
        $item["question"] = $aQuiz->getQuestion();
        $item["number_of_options"] = $aQuiz->getNumberOfOptions();
        $item["options_content"] = $aQuiz ->getOptionsContent();
        $item["correct_answer"] = $aQuiz->getCorrectAnswer();
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
   
    print_r ($postJSON);
?>
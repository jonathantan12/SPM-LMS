<?php
    require_once('common.php');

    $dao = new quizzesDAO();
    // Use this to pass in the section_id variable into the class function currently it is hard coded.
    // $section_id = $_GET["section_id"];
    $section_id = 1;

    $quizzes = $dao->getQuestions($section_id);

    $items = [];
    foreach ( $quizzes as $aQuiz ) {
        $item["quiz_id"] = $aQuiz->getQuizId();  
        $item["section_id"] = $aQuiz->getSectionId();
        $item["question"] = $aQuiz->getQuestion();
        $item["question_type"] = $aQuiz->getQuestionType();
        $item["number_of_options"] = $aQuiz->getNumberOfOptions();
        $item["correct_answer"] = $aQuiz->getCorrectAnswer();
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
    echo $postJSON;
?>
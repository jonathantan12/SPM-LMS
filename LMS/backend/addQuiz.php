<?php
    //connect to database to put these data in
    //redirect user to set up profile
    require_once('common.php');
    // $quiz_id=$_GET['quiz_id'];
    // $section_id=$_GET['section_id'];
    // $question = $_GET['question'];
    // $question_type=$_GET["question_type"];
    // $number_of_options= $_GET["number_of_options"];
    // $correct_answer=$_GET["correct_answer"];
    $quiz_id="1";
    $section_id="1";
    $question = "this is a question";
    $question_type="truefalse";
    $number_of_options= "2";
    $correct_answer="true";
    $quiz = new quizzes($quiz_id, $section_id, $question, $question_type, $number_of_options, $correct_answer);
    $quizzesDAO = new QuizzesDAO;
    $result = $quizzesDAO->add($quiz);
    $ret = [];

?>
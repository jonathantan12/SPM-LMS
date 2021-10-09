<?php
    //connect to database to put these data in
    //redirect user to set up profile
    require_once('common.php');
    $arr =json_decode($_POST['arr'],true);
    //print_r($arr);
    //print_r($a["quiz_id"]);
    foreach ($arr as $a){
        //print_r($a);
        $course_id = $a["course_id"];
        $course_class_id = $a["course_class_id"];
        $section_id = $a["section_id"];
        $quiz_id = $a["quiz_id"];
        $quiz_title = $a["quiz_title"];
        $quiz_type = $a["quiz_type"];
        $question_no = $a["question_no"];
        $question = $a["question"];
        $number_of_options = $a["number_of_options"];
        $options_content = json_encode($a["options_content"]);
        $correct_answer = $a["correct_answer"];

        $quiz = new quizzes($course_id, $course_class_id, $section_id, $quiz_id, $quiz_title, $quiz_type, $question_no, $question, $number_of_options, $options_content, $correct_answer);
        //print_r($quiz);
        $quizzesDAO = new QuizzesDAO;
        $result = $quizzesDAO->add($quiz);
        print_r($result);

    }
    //print_r($_POST['arr']);
    // $quiz_id=$_GET['quiz_id'];
    // //echo $quiz_id;
    // $section_id=$_GET['section_id'];
    // $question = $_GET['question'];
    // $question_type=$_GET["question_type"];
    // $number_of_options= $_GET["number_of_options"];
    // $correct_answer=$_GET["correct_answer"];
   
    // $quiz = new quizzes($quiz_id, $section_id, $question, $question_type, $number_of_options, $correct_answer);
    // $quizzesDAO = new QuizzesDAO;
    // $result = $quizzesDAO->add($quiz);
    // $ret = [];

?>
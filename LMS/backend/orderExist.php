<?php
    //call database and check username
    require_once('common.php');
    $course_id=$_GET['course_id'];
    $order = $_GET['order'];
    $getSectionDAO = new getSectionDAO;
    $result = $getSectionDAO->lookFor($course_id, $order);
    if(!$result){
        echo 'false'; //username is taken
    } else{
        echo 'true';
    }
?>
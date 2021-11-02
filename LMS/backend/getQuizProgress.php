<?php
    require_once('common.php');

    $dao = new quizProgressDAO();
    $quizProgress = $dao->getAllCompletionStatus($_GET['userId'],$_GET['courseId'],$_GET['courseClassId']);
    $items = [];
    foreach ( $quizProgress as $aquizProgress ) {
        $item["user_id"] = $aquizProgress->getUserId();
        $item["course_id"] = $aquizProgress->getCourseId();
        $item["course_class_id"] = $aquizProgress->getCourseClassId();
        $item["section_id"] = $aquizProgress->getSectionId();
        $item["completion_status"] = $aquizProgress->getCompletionStatus();
        $items[] = $item;
    }
    

    // make posts into json and return json data
    $postJSON = json_encode($items);
    echo $postJSON;

?>
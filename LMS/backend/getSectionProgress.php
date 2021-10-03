<?php
    require_once('common.php');

    $dao = new sectionProgressDAO();
    // Use this to pass in the user_id variable into the class function currently it is hard coded.
    // $user_id = $_GET["user_id"];
    $user_id = 1;
    $sectionProgress = $dao->getSectionProgress($user_id);

    $items = [];
    foreach ( $sectionProgress as $aSectionProgress ) {
        $item["section_progress_id"] = $aSectionProgress->getSectionProgressId();
        $item["user_id"] = $aSectionProgress->getUserId();
        $item["user_name"] = $aSectionProgress->getUserName();
        $item["course_id"] = $aSectionProgress->getCourseId();
        $item["course_name"] = $aSectionProgress->getCourseName();
        $item["class_name"] = $aSectionProgress->getClassName();
        $item["section_id"] = $aSectionProgress->getSectionId();
        $item["section_completion_status"] = $aSectionProgress->getSectionCompletionStatus();
        $item["quiz_completion_status"] = $aSectionProgress->getQuizCompletionStatus();
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
    echo $postJSON;
?>
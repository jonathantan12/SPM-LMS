<?php
    require_once('common.php');

    $dao = new coursePrerequisitesDAO();
    $coursePrerequisites = $dao->getCoursePrerequisites((int)$_GET["course_id"]);

    $items = [];
    foreach ($coursePrerequisites as $aCoursePrerequisites) {
        $item["id"] = $aCoursePrerequisites->getId();
        $item["course_id"] = $aCoursePrerequisites->getCourseId();
        $item["course_name"] = $aCoursePrerequisites->getCourseName();
        $item["prerequisite_course_id"] = $aCoursePrerequisites->getPrerequisiteCourseId();
        $item["prerequisite_course_name"] = $aCoursePrerequisites->getPrerequisiteCourseName();
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
    echo $postJSON;
?>
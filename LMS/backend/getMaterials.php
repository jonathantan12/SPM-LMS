<?php
    require_once('common.php');

    $dao = new MaterialsDAO();
    $materials = $dao->retrieveAll($_GET['courseId'],$_GET['courseClassId']);
    $items = [];
    foreach ( $materials as $amaterial ) {
        $item["course_id"] = $amaterial->getCourseId();
        $item["course_class_id"] = $amaterial->getCourseClassId();
        $item["section_id"] = $amaterial->getSectionId();
        $item["material_id"] = $amaterial->getMaterialId();
        $item["material_name"] = $amaterial->getMaterialName();
        $item["material_url"] = $amaterial->getMaterialUrl();
        $item["completion_status"] = $amaterial->getCompletionStatus();
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
    echo $postJSON;

?>
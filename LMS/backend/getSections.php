<?php
    require_once('common.php');
    $dao = new sectionsDAO();
    // Use this to pass in the course_id variable into the class function currently it is hard coded.
    // $course_id = $_GET["course_id"];
    if(isset($_GET['courseId'])){
        $course_id = $_GET['courseId'];
    } else {
        $course_id = 1;
    }

    $sections= $dao->getSections($course_id);

    $items = [];
    foreach ( $sections as $aSection ) {
        $item["section_id"] = $aSection->getSectionId();  
        $item["course_id"] = $aSection->getCourseId();
        $item["course_name"] = $aSection->getCourseName();
        $item["class_name"] = $aSection->getClassName();
        $item["course_section_number"] = $aSection->getCourseSectionNumber();
        $item["section_name"] = $aSection->getSectionName();
        $item["course_material_link"] = $aSection->getCourseMaterialLink();
        $items[] = $item;
    }

    // make posts into json and return json data
    $postJSON = json_encode($items);
    echo $postJSON;

?>
<?php
require_once 'autoload.php';

class sectionsDAO {
    public function getSections($course_id) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'select * from sections where course_id=:course_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_STR);
        $stmt->execute();

        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $stmt->fetch()) {
            $result[] = new sections($row['section_id'], $row['course_id'] , $row['course_name'], $row['class_name'], $row['course_section_number'], $row['section_name'], $row['course_material_link']);
        }
        $stmt = null;
        $pdo = null;
        
        return $result;
    }
}

$dao = new sectionsDAO();
// Use this to pass in the course_id variable into the class function currently it is hard coded.
// $course_id = $_GET["course_id"];
$course_id = 1;

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
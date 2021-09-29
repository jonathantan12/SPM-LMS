<?php
require_once 'autoload.php';

class coursePrerequisitesDAO {
    public function getCoursePrerequisites() {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'select * from course_prerequisites';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $stmt->fetch()) {
            $result[] = new coursePrerequisites($row['id'], $row['course_id'], $row['course_name'], $row['prerequisite_course_id'], $row['prerequisite_course_name']);
        }
        $stmt = null;
        $pdo = null;

        return $result;
    }

}

$dao = new coursePrerequisitesDAO();
$coursePrerequisites = $dao->getCoursePrerequisites();

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

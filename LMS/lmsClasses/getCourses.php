<?php
require_once 'autoload.php';

class coursesDAO {
    public function getCourses() {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'select * from courses';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $stmt->fetch()) {
            $result[] = new coursePrerequisites($row['course_id'], $row['course_name'], $row['course_desc'], $row['class_name'], $row['start_date'], $row['end_date'], $row['slots_available']);
        }
        $stmt = null;
        $pdo = null;

        return $result;
    }

}

$dao = new coursesDAO();
$coursePrerequisites = $dao->getCourses();

$items = [];
foreach ( $coursePrerequisites as $aCoursePrerequisites ) {
    $item["course_id"] = $aCoursePrerequisites->getCourseId();
    $item["course_name"] = $aCoursePrerequisites->getCourseName();
    $item["course_desc"] = $aCoursePrerequisites->getCourseDesc();
    $item["course_desc"] = $aCoursePrerequisites->getClassName();
    $item["course_desc"] = $aCoursePrerequisites->getStartDate();
    $item["course_desc"] = $aCoursePrerequisites->getEndDate();
    $item["course_desc"] = $aCoursePrerequisites->getSlotsAvailable();
    $items[] = $item;
}

// make posts into json and return json data
$postJSON = json_encode($items);
echo $postJSON;

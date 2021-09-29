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
            $result[] = new courses($row['course_id'], $row['course_name'], $row['course_desc'], $row['class_name'], $row['start_date'], $row['end_date'], $row['slots_available'], $row['image']);
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
    $item["class_name"] = $aCoursePrerequisites->getClassName();
    $item["start_date"] = $aCoursePrerequisites->getStartDate();
    $item["end_date"] = $aCoursePrerequisites->getEndDate();
    $item["slots_available"] = $aCoursePrerequisites->getSlotsAvailable();
    $item["image"] = $aCoursePrerequisites->getImage();
    $items[] = $item;
}

// make posts into json and return json data
$postJSON = json_encode($items);
echo $postJSON;

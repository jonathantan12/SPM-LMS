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
            $result[] = new coursePrerequisites($row['id'], $row['course_id'], $row['prerequisites_course_id']);
        }
        $stmt = null;
        $pdo = null;

        return $result;
    }

}

$dao = new coursePrerequisitesDAO();
$coursePrerequisites = $dao->getCoursePrerequisites();


$items = [];
foreach ( $coursePrerequisites as $aCoursePrerequisites ) {
    $item["product_id"] = $aCoursePrerequisites->getId();
    $item["product_name"] = $aCoursePrerequisites->getCourseId();
    $item["product_desc"] = $aCoursePrerequisites->getPrerequisitesCourseId();
    $items[] = $item;
}

// make posts into json and return json data
$postJSON = json_encode($items);
echo $postJSON;

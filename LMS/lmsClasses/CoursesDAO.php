<?php
require_once 'autoload.php';

class CoursesDAO {
    public function getCourses() {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'select * from courses';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $stmt->fetch()) {
            $result[] = new courses($row['course_id'], $row['course_name'], $row['course_desc'], $row['class_name'], $row['start_date'], $row['end_date'], $row['slots_available'], $row['trainer_id'], $row['trainer_name'],$row['image']);
        }
        $stmt = null;
        $pdo = null;

        return $result;
    }

}

// $dao = new coursesDAO();
// $courses = $dao->getCourses();

// $items = [];
// foreach ( $courses as $aCourse ) {
//     $item["course_id"] = $aCourse->getCourseId();
//     $item["course_name"] = $aCourse->getCourseName();
//     $item["course_desc"] = $aCourse->getCourseDesc();
//     $item["class_name"] = $aCourse->getClassName();
//     $item["start_date"] = $aCourse->getStartDate();
//     $item["end_date"] = $aCourse->getEndDate();
//     $item["slots_available"] = $aCourse->getSlotsAvailable();
//     $item["image"] = $aCourse->getImage();
//     $items[] = $item;
// }

// // make posts into json and return json data
// $postJSON = json_encode($items);
// echo $postJSON;

?>

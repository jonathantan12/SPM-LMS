<?php
require_once('connectionManager.php');
require_once('courses.php');

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
            $result[] = new courses($row['course_id'], $row['course_name'], $row['course_desc'], $row['image']);
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
//     $item["image"] = $aCourse->getImage();
//     $items[] = $item;
// }

// // make posts into json and return json data
// $postJSON = json_encode($items);
// echo $postJSON;

?>

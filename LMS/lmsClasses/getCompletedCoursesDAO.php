<?php
require_once 'autoload.php';

class completedCoursesDAO {
    public function getCompletedCourses($user_id) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'select * from completed_courses where user_id=:user_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();

        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $stmt->fetch()) {
            $result[] = new completedCourses($row['completed_course_id'], $row['user_id'], $row['user_name'], $row['course_id'] ,$row['course_name']);
        }
        $stmt = null;
        $pdo = null;
        
        return $result;
    }
}

$dao = new completedCoursesDAO();
// Use this to pass in the user_id variable into the class function currently it is hard coded.
// $user_id = $_GET["user_id"];
$user_id = 1;
$completedCourses = $dao->getCompletedCourses($user_id);

$items = [];
foreach ( $completedCourses as $aCompletedCourse ) {
    $item["completed_course_id"] = $aCompletedCourse->getCompletedCourseId();
    $item["user_id"] = $aCompletedCourse->getUserId();
    $item["user_name"] = $aCompletedCourse->getUserName();
    $item["course_id"] = $aCompletedCourse->getCourseId();
    $item["course_name"] = $aCompletedCourse->getCourseName();
    $items[] = $item;
}

// make posts into json and return json data
$postJSON = json_encode($items);
echo $postJSON;

?>
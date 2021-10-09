<?php
require_once 'autoload.php';

class enrolledCoursesDAO {
    public function getEnrolledCourses($user_id) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'select * from enrolled_courses where user_id=:user_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();

        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $stmt->fetch()) {
            $result[] = new enrolledCourses($row['enrolled_course_id'], $row['user_id'], $row['user_name'], $row['course_id'] ,$row['course_name']);
        }
        $stmt = null;
        $pdo = null;
        
        return $result;
    }

    public function addEnrolledCourses($user_id, $user_name, $course_id, $course_name) {
        $result = FALSE;
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'INSERT INTO enrolled_courses VALUES (default, :user_id, :user_name, :course_id, :course_name)';
        
        try {
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
            $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
            $stmt->bindParam(':course_name', $course_name, PDO::PARAM_STR);

            if($stmt->execute()) {
                $result = TRUE;
            }
        } catch (Exception $e) {
            return $result;    
        }

        $stmt = null;
        $pdo = null;

        return $result;
    }
}

// $dao = new enrolledCoursesDAO();
// // Use this to pass in the user_id variable into the class function currently it is hard coded.
// // $user_id = $_GET["user_id"];
// $user_id = 1;
// $enrolledCourses = $dao->getEnrolledCourses($user_id);

// $items = [];
// foreach ( $enrolledCourses as $aEnrolledCourses ) {
//     $item["enrolled_course_id"] = $aEnrolledCourses->getEnrolledCourseId();
//     $item["user_id"] = $aEnrolledCourses->getUserId();
//     $item["user_name"] = $aEnrolledCourses->getUserName();
//     $item["course_id"] = $aEnrolledCourses->getCourseId();
//     $item["course_name"] = $aEnrolledCourses->getCourseName();
//     $items[] = $item;
// }

// // make posts into json and return json data
// $postJSON = json_encode($items);
// echo $postJSON;

?>
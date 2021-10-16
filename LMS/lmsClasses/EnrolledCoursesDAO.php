<?php
require_once 'autoload.php';

class EnrolledCoursesDAO {
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
}

class EnrollCoursesDAO {
    public function addCourse($courseId) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        // INSERT INTO `enrolled_courses` (`enrolled_course_id`, `user_id`, `user_name`,`course_id`, `course_name`) VALUES
        // (1, 1, 'Jonathan', 1, 'Electrical Engineering'),
        // (2, 1, 'Jonathan', 2, 'Introduction to Mechanical Engineering'),
        // (3, 1, 'Jonathan', 3, 'Introduction to Scrum Methodology');
        // COMMIT;
        $sql = 'insert into enrolled_courses (user_id, user_name, course_id, course_name) values (:user_id, :user_name, :course_id, :course_name)';
        $user_id = "";
        $user_name = "";
        $course_id = "";
        $course_name = "";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->bindParam(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_STR);
        $stmt->bindParam(':course_name', $course_name, PDO::PARAM_STR);
        $isAddOK = $stmt->execute();
        if ($isAddOK){
            echo "Succesffully Enrolled";
        }
        else{
            echo "Enrolment Failed";
        }
        $stmt = null;
        $pdo = null;

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
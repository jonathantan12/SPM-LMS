<?php
require_once 'autoload.php';

class courseTrainersDAO {
    public function getCourseTrainers($course_id) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'select * from course_trainers where course_id=:course_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_STR);
        $stmt->execute();

        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $stmt->fetch()) {
            $result[] = new courseTrainers($row['course_trainer_id'], $row['course_id'] ,$row['course_name'], $row['user_id'], $row['user_name']);
        }
        $stmt = null;
        $pdo = null;
        
        return $result;
    }
}

// $dao = new courseTrainersDAO();
// // Use this to pass in the course_id variable into the class function currently it is hard coded.
// // $course_id = $_GET["course_id"];
// $course_id = 1;

// $courseTrainers = $dao->getCourseTrainers($course_id);

// $items = [];
// foreach ( $courseTrainers as $aCourseTrainer ) {
//     $item["course_trainer_id"] = $aCourseTrainer->getCourseTrainerId();  
//     $item["course_id"] = $aCourseTrainer->getCourseId();
//     $item["course_name"] = $aCourseTrainer->getCourseName();
//     $item["user_id"] = $aCourseTrainer->getUserId();
//     $item["user_name"] = $aCourseTrainer->getUserName();
//     $items[] = $item;
// }

// // make posts into json and return json data
// $postJSON = json_encode($items);
// echo $postJSON;

?>
<?php
require_once 'autoload.php';

class sectionProgressDAO {
    public function getSectionProgress($user_id) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'select * from section_progress where user_id=:user_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();

        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $stmt->fetch()) {
            $result[] = new sectionProgress($row['section_progress_id'], $row['user_id'], $row['user_name'], $row['course_id'] ,$row['course_name'], $row['class_name'], $row['section_id'], $row['section_completion_status'], $row['quiz_completion_status']);
        }
        $stmt = null;
        $pdo = null;
        
        return $result;
    }
}

// $dao = new sectionProgressDAO();
// // Use this to pass in the user_id variable into the class function currently it is hard coded.
// // $user_id = $_GET["user_id"];
// $user_id = 1;
// $sectionProgress = $dao->getSectionProgress($user_id);

// $items = [];
// foreach ( $sectionProgress as $aSectionProgress ) {
//     $item["section_progress_id"] = $aSectionProgress->getSectionProgressId();
//     $item["user_id"] = $aSectionProgress->getUserId();
//     $item["user_name"] = $aSectionProgress->getUserName();
//     $item["course_id"] = $aSectionProgress->getCourseId();
//     $item["course_name"] = $aSectionProgress->getCourseName();
//     $item["class_name"] = $aSectionProgress->getClassName();
//     $item["section_id"] = $aSectionProgress->getSectionId();
//     $item["section_completion_status"] = $aSectionProgress->getSectionCompletionStatus();
//     $item["quiz_completion_status"] = $aSectionProgress->getQuizCompletionStatus();
//     $items[] = $item;
// }

// // make posts into json and return json data
// $postJSON = json_encode($items);
// echo $postJSON;

?>
<?php
require_once 'autoload.php';

class trainerQualificationsDAO {
    public function getTrainerQualifications($user_id) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'select * from trainer_qualifications where user_id=:user_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->execute();

        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $stmt->fetch()) {
            $result[] = new trainerQualifications($row['trainer_qualifications_id'], $row['user_id'], $row['user_name'], $row['course_id'] ,$row['course_name']);
        }
        $stmt = null;
        $pdo = null;
        
        return $result;
    }
}

$dao = new trainerQualificationsDAO();
// Use this to pass in the user_id variable into the class function currently it is hard coded.
// $user_id = $_GET["user_id"];
$user_id = 2;

$trainerQualifications = $dao->getTrainerQualifications($user_id);

$items = [];
foreach ( $trainerQualifications as $aTrainerQualifications ) {
    $item["trainer_qualifications_id"] = $aTrainerQualifications->getTrainerQualificationsId();
    $item["user_id"] = $aTrainerQualifications->getUserId();
    $item["user_name"] = $aTrainerQualifications->getUserName();
    $item["course_id"] = $aTrainerQualifications->getCourseId();
    $item["course_name"] = $aTrainerQualifications->getCourseName();
    $items[] = $item;
}

// make posts into json and return json data
$postJSON = json_encode($items);
echo $postJSON;

?>
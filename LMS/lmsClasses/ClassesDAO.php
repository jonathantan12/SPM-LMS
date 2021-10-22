<?php
require_once 'autoload.php';

class ClassesDAO {
    public function getClassesWithVacancy($course_id) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'SELECT * from classes where course_id = :course_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $stmt->fetch()) {
            $result[] = new classes($row['course_id'], $row['course_name'], $row['class_name'], $row['start_date'], $row['end_date'], $row['slots_available'], $row['trainer_id'], $row['trainer_name']);
        }
        $stmt = null;
        $pdo = null;

        return $result;
    }

}


?>
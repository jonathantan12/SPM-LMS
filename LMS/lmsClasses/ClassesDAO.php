<?php
require_once 'autoload.php';

class CoursesDAO {
    public function getClasses() {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'select * from classes';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $stmt->fetch()) {
            $result[] = new courses($row['course_id'], $row['course_name'], $row['class_name'], $row['start_date'], $row['end_date'], $row['slots_available'], $row['trainer_id'], $row['trainer_name']);
        }
        $stmt = null;
        $pdo = null;

        return $result;
    }

}


?>
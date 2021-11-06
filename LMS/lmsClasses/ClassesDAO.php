<?php
require_once 'autoload.php';

class ClassesDAO {
    public function getClasses() {

        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'SELECT * from classes';
        $stmt = $pdo->prepare($sql);
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

    public function updateClassVacancy($course_id, $class_name) {

        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'UPDATE classes set slots_available = slots_available-1 where course_id = :course_id and class_name = :class_name';

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':course_id',$course_id, PDO::PARAM_INT);
            $stmt->bindParam(':class_name', $class_name, PDO::PARAM_STR);

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


?>
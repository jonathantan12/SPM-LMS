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
            $result[] = new completedCourses($row['completed_course_id'], $row['user_id'], $row['user_name'], $row['course_id'] ,$row['course_name'], $row['image']);
        }
        $stmt = null;
        $pdo = null;
        
        return $result;
    }
}

?>
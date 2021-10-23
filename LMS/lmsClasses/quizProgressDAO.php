<?php
class QuizProgressDAO {

    //retrieve all info of a particular user
    public function getCompletionStatus($user_id,$course_id,$course_class_id, $section_id) {
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();

        $sql = 'SELECT completion_status FROM quiz_progress WHERE user_id = :user_id && course_id = :course_id && course_class_id = :course_class_id && section_id = :section_id'; 
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':course_id',$course_id, PDO::PARAM_INT);
        $stmt->bindParam(':course_class_id',$course_class_id, PDO::PARAM_INT);
        $stmt->bindParam(':section_id', $section_id, PDO::PARAM_INT);
        $stmt->bindParam(':completion_status', $completion_status, PDO::PARAM_STR);


        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $result = [];
        while( $row = $stmt->fetch() ) {
            $result[] = new quizProgress($row['completion_status']);
        }

        $stmt = null;
        $conn = null;

        return $result;
    }

    
    public function update($progress) {
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection   ();

        $user_id = $progress->getUserId();
        $course_id = $progress->getCourseId();
        $course_class_id = $progress->getCourseClassId();
        $section_id = $progress->getSectionId();
        $completion_status = $progress->getCompletionStatus();

        $sql = 'UPDATE quiz_progress SET completion_status = :completion_status WHERE user_id = :user_id && course_id = :course_id && course_class_id = :course_class_id && section_id = :section_id'; 

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':course_id',$course_id, PDO::PARAM_INT);
        $stmt->bindParam(':course_class_id',$course_class_id, PDO::PARAM_INT);
        $stmt->bindParam(':section_id', $section_id, PDO::PARAM_INT);
        $stmt->bindParam(':completion_status', $completion_status, PDO::PARAM_STR);

        $status = $stmt->execute();
        
        $stmt = null;
        $conn = null;

        return $status;

    }
    
}

?>

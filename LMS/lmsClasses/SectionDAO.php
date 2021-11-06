<?php
class sectionDAO {

    # Add a new user into the database
    // expects a user class
    public function add($section) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        $sql = 'insert into section (section_id, course_id, course_class_id, section_title) values (:section_id, :course_id, :course_class_id, :section_title)';
        $isAddOK = FALSE;
        try { 
            $stmt = $pdo->prepare($sql); 

            $section_id = $section->getSectionId();
            $course_id = $section->getCourseId();
            $course_class_id = $section->getCourseClassId();
            $section_title=$section->getSectionTitle();
           
            
            $stmt->bindParam(':section_id', $section_id, PDO::PARAM_INT);
            $stmt->bindParam('course_id', $course_id, PDO::PARAM_INT);
            $stmt->bindParam('course_class_id', $course_class_id, PDO::PARAM_INT);
            $stmt->bindParam(':section_title', $section_title, PDO::PARAM_STR);
            
        
            if ($stmt->execute()) {
                $isAddOK = TRUE;
            }
            
            $stmt->closeCursor();
            $pdo = null;
        } catch (Exception $e) {
            return $isAddOK;    
        }

        return $isAddOK;
    }

    //check if a order under a course is taken
    
    

    
}

?>

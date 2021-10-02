<?php
class sectionDAO {

    # Add a new user into the database
    // expects a user class
    public function add($section) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        $sql = 'insert into section (section_id, course_id, section_title, order) values (:course_id, :section_id, :section_title, :order)';
        $isAddOK = FALSE;
        try { 
            $stmt = $pdo->prepare($sql); 

            $section_id = $section->getSectionId();
            $course_id = $section->getCourseId();
            $section_title=$section->getSectionTitle();
            $order=$section->getOrder();
            
            $stmt->bindParam(':section_id', $section_id, PDO::PARAM_STR);
            $stmt->bindParam('course_id', $course_id, PDO::PARAM_STR);
            $stmt->bindParam(':section_title', $section_title, PDO::PARAM_STR);
            $stmt->bindParam(':order', $order, PDO::PARAM_STR);
            
        
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
    public function lookFor($course_id, $order) {
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();

        $sql = "select course_id, order from section where course_id = :course_id and order = :order";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':course_id', $course_id, PDO::PARAM_STR);
        $stmt->bindParam(':order', $order, PDO::PARAM_STR);

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

		$add_section = true;
        if ($row = $stmt->fetch() ) {
            $add_section = false;
        }

        $stmt = null;
        $conn = null;
        
        return $add_section;
    }

    
}

?>

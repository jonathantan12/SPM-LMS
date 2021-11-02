<?php
require_once 'autoload.php';

class MaterialsDAO {
    public function retrieveAll($course_id,$course_class_id,$section_id){
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        $sql = 'select * from materials where course_id=:course_id AND course_class_id=:course_class_id AND section_id=:section_id ;';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':course_id',$course_id, PDO::PARAM_INT);
        $stmt->bindParam(':course_class_id',$course_class_id, PDO::PARAM_INT);
        $stmt->bindParam(':section_id', $section_id, PDO::PARAM_INT);
       
        $stmt->execute();

        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $stmt->fetch()) {
            $result[] = new materials($row['course_id'], $row['course_class_id'], $row['section_id'], $row['material_id'], $row['material_name'], $row['material_url'], $row['completion_status']);
        }
       
        $stmt = null;
        $pdo = null;
        
        return $result;
    }

    public function add($materialObj) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        $sql = 'INSERT INTO materials (course_id, course_class_id, section_id, material_id, material_name, material_url, completion_status) values (:course_id, :course_class_id, :section_id, :material_id, :material_name, :material_url, :completion_status)';
        $isAddOK = FALSE;
        try { 
            $stmt = $pdo->prepare($sql); 

            $course_id = $materialObj->getCourseId();
            $course_class_id = $materialObj->getCourseClassId();
            $section_id = $materialObj->getSectionId();
            $material_id = $materialObj->getMaterialId();
            $material_name = $materialObj->getMaterialName();
            $material_url = $materialObj->getMaterialUrl();
            $completion_status = $materialObj->getCompletionStatus();
            
            $stmt->bindParam(':course_id',$course_id, PDO::PARAM_INT);
            $stmt->bindParam(':course_class_id',$course_class_id, PDO::PARAM_INT);
            $stmt->bindParam(':section_id', $section_id, PDO::PARAM_INT);
            $stmt->bindParam(':material_id', $material_id, PDO::PARAM_INT);
            $stmt->bindParam(':material_name', $material_name, PDO::PARAM_STR);
            $stmt->bindParam(':material_url', $material_url, PDO::PARAM_STR);
            $stmt->bindParam(':completion_status', $completion_status, PDO::PARAM_STR);
        
            if ($stmt->execute()) {
                $isAddOK = TRUE;
                return $isAddOK;
            }
            
            $stmt->closeCursor();
            $pdo = null;
        } catch (Exception $e) {
            return $e;
            return $isAddOK;    
        }

    }

    public function delete($course_id, $course_class_id, $section_id, $material_id) {
        $result = FALSE;
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'DELETE FROM materials WHERE course_id = :course_id && course_class_id = :course_class_id && section_id = :section_id && material_id = :material_id';
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':course_id',$course_id, PDO::PARAM_INT);
            $stmt->bindParam(':course_class_id',$course_class_id, PDO::PARAM_INT);
            $stmt->bindParam(':section_id', $section_id, PDO::PARAM_INT);
            $stmt->bindParam(':material_id', $material_id, PDO::PARAM_STR);

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
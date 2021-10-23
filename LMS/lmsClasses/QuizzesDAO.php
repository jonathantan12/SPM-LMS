<?php
require_once 'autoload.php';

class quizzesDAO {
    public function retrieveAll($course_id,$course_class_id,$section_id){
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        $sql = 'select * from quizzes where course_id=:course_id AND course_class_id=:course_class_id AND section_id=:section_id ;';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':course_id',$course_id, PDO::PARAM_INT);
        $stmt->bindParam(':course_class_id',$course_class_id, PDO::PARAM_INT);
        $stmt->bindParam(':section_id', $section_id, PDO::PARAM_INT);
       
        $stmt->execute();

        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $stmt->fetch()) {
            $result[] = new quizzes($row['course_id'], $row['course_class_id'], $row['section_id'], $row['quiz_id'], $row['quiz_title'], $row['quiz_type'], $row['question_no'], $row['question'], $row['number_of_options'],$row['options_content'],$row['correct_answer']);
        }
       
        $stmt = null;
        $pdo = null;
        
        return $result;
    }

    
    public function getQuizzes($course_id,$course_class_id,$section_id,$quiz_id) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        $sql = 'select * from quizzes where course_id=:course_id AND course_class_id=:course_class_id AND section_id=:section_id AND quiz_id=:quiz_id ;';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':course_id',$course_id, PDO::PARAM_INT);
        $stmt->bindParam(':course_class_id',$course_class_id, PDO::PARAM_INT);
        $stmt->bindParam(':section_id', $section_id, PDO::PARAM_INT);
        $stmt->bindParam(':quiz_id', $quiz_id, PDO::PARAM_INT);
        $stmt->execute();

        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        while($row = $stmt->fetch()) {
            $result[] = new quizzes($row['course_id'], $row['course_class_id'], $row['section_id'], $row['quiz_id'], $row['quiz_title'], $row['quiz_type'], $row['question_no'], $row['question'], $row['number_of_options'],$row['options_content'],$row['correct_answer']);
        }
       
        $stmt = null;
        $pdo = null;
        
        return $result;
    }



    public function add($quiz) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        $sql = 'INSERT INTO quizzes (course_id, course_class_id, section_id, quiz_id, quiz_title, quiz_type, question_no, question, number_of_options, options_content, correct_answer) values (:course_id, :course_class_id, :section_id, :quiz_id, :quiz_title, :quiz_type, :question_no, :question, :number_of_options, :options_content, :correct_answer)';
        $isAddOK = FALSE;
        try { 
            $stmt = $pdo->prepare($sql); 

            $course_id = $quiz->getCourseId();
            $course_class_id = $quiz->getCourseClassId();
            $section_id = $quiz->getSectionId();
            $quiz_id = $quiz->getQuizId();
            $quiz_title = $quiz->getQuizTitle();
            $quiz_type = $quiz->getQuizType();
            $question_no = $quiz->getQuestionNo();
            $question = $quiz->getQuestion();
            $number_of_options = $quiz->getNumberOfOptions();
            $options_content = $quiz->getOptionsContent();
            $correct_answer = $quiz-> getCorrectAnswer();
            
            $stmt->bindParam(':course_id',$course_id, PDO::PARAM_INT);
            $stmt->bindParam(':course_class_id',$course_class_id, PDO::PARAM_INT);
            $stmt->bindParam(':section_id', $section_id, PDO::PARAM_INT);
            $stmt->bindParam(':quiz_id', $quiz_id, PDO::PARAM_INT);
            $stmt->bindParam(':quiz_title', $quiz_title, PDO::PARAM_STR);
            $stmt->bindParam(':quiz_type', $quiz_type, PDO::PARAM_STR);
            $stmt->bindParam(':question_no', $question_no, PDO::PARAM_INT);
            $stmt->bindParam(':question', $question, PDO::PARAM_STR);
            $stmt->bindParam(':number_of_options', $number_of_options, PDO::PARAM_STR);
            $stmt->bindParam(':options_content', $options_content, PDO::PARAM_STR);
            $stmt->bindParam(':correct_answer', $correct_answer, PDO::PARAM_STR);
        
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

    public function deleteQuizzes($course_id, $course_class_id, $section_id, $quiz_id) {
        $result = FALSE;
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'DELETE FROM quizzes WHERE course_id = :course_id && course_class_id = :course_class_id && section_id = :section_id && quiz_id = :quiz_id';
        
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':course_id',$course_id, PDO::PARAM_INT);
            $stmt->bindParam(':course_class_id',$course_class_id, PDO::PARAM_INT);
            $stmt->bindParam(':section_id', $section_id, PDO::PARAM_INT);
            $stmt->bindParam(':quiz_id', $quiz_id, PDO::PARAM_INT);

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
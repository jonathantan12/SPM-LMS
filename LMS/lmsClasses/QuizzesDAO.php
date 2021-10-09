<?php
require_once 'autoload.php';

class quizzesDAO {
    // public function getQuestions($section_id) {
    //     $connMgr = new ConnectionManager();
    //     $pdo = $connMgr->getConnection();

    //     $sql = 'select * from quizzes where section_id=:section_id';
    //     $stmt = $pdo->prepare($sql);
    //     $stmt->bindParam(':section_id', $section_id, PDO::PARAM_STR);
    //     $stmt->execute();

    //     $result = [];
    //     $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //     while($row = $stmt->fetch()) {
    //         $result[] = new quizzes($row['quiz_id'], $row['section_id'] , $row['question'], $row['question_type'], $row['number_of_options'], $row['correct_answer']);
    //     }
    //     $stmt = null;
    //     $pdo = null;
        
    //     return $result;
    // }



    public function add($quiz) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();
        $sql = 'INSERT INTO quizzes (course_id, section_id, quiz_id, question_no, question, number_of_options, correct_answer) values (:course_id, :section_id, :quiz_id, :question_no, :question, :number_of_options, :correct_answer)';
        $isAddOK = "FALSE";
        try { 
            $stmt = $pdo->prepare($sql); 

            $course_id = $quiz->getCourseId();
            $section_id = $quiz->getSectionId();
            $quiz_id = $quiz->getQuizId();
            $question_no = $quiz->getQuestionNo();
            $question = $quiz->getQuestion();
            $number_of_options = $quiz->getNumberOfOptions();
            $correct_answer = $quiz-> getCorrectAnswer();
            
            $stmt->bindParam(':course_id',$course_id, PDO::PARAM_INT);
            $stmt->bindParam(':section_id', $section_id, PDO::PARAM_INT);
            $stmt->bindParam(':quiz_id', $quiz_id, PDO::PARAM_INT);
            $stmt->bindParam(':question_no', $question_no, PDO::PARAM_INT);
            $stmt->bindParam(':question', $question, PDO::PARAM_STR);
            $stmt->bindParam(':number_of_options', $number_of_options, PDO::PARAM_STR);
            $stmt->bindParam(':correct_answer', $correct_answer, PDO::PARAM_STR);
        
            if ($stmt->execute()) {
                $isAddOK = "TRUE";
            }
            
            $stmt->closeCursor();
            $pdo = null;
        } catch (Exception $e) {
            return $e;
            return $isAddOK;    
        }

        return $isAddOK;
    }
}

// $dao = new questionsDAO();
// // Use this to pass in the section_id variable into the class function currently it is hard coded.
// // $section_id = $_GET["section_id"];
// $section_id = 1;

// $quizzes = $dao->getQuestions($section_id);

// $items = [];
// foreach ( $quizzes as $aQuiz ) {
//     $item["quiz_id"] = $aQuiz->getQuizId();  
//     $item["section_id"] = $aQuiz->getSectionId();
//     $item["question"] = $aQuiz->getQuestion();
//     $item["question_type"] = $aQuiz->getQuestionType();
//     $item["number_of_options"] = $aQuiz->getNumberOfOptions();
//     $item["correct_answer"] = $aQuiz->getCorrectAnswer();
//     $items[] = $item;
// }

// // make posts into json and return json data
// $postJSON = json_encode($items);
// echo $postJSON;






?>
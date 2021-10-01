<?php
require_once 'autoload.php';

class questionsDAO {
    public function getQuestions($section_id) {
        $connMgr = new ConnectionManager();
        $pdo = $connMgr->getConnection();

        $sql = 'select * from quizzes where section_id=:section_id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':section_id', $section_id, PDO::PARAM_STR);
        $stmt->execute();

        $result = [];
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        while($row = $stmt->fetch()) {
            $result[] = new quizzes($row['quiz_id'], $row['section_id'] , $row['question'], $row['question_type'], $row['number_of_options'], $row['correct_answer']);
        }
        $stmt = null;
        $pdo = null;
        
        return $result;
    }
}

$dao = new questionsDAO();
// Use this to pass in the section_id variable into the class function currently it is hard coded.
// $section_id = $_GET["section_id"];
$section_id = 1;

$quizzes = $dao->getQuestions($section_id);

$items = [];
foreach ( $quizzes as $aQuiz ) {
    $item["quiz_id"] = $aQuiz->getQuizId();  
    $item["section_id"] = $aQuiz->getSectionId();
    $item["question"] = $aQuiz->getQuestion();
    $item["question_type"] = $aQuiz->getQuestionType();
    $item["number_of_options"] = $aQuiz->getNumberOfOptions();
    $item["correct_answer"] = $aQuiz->getCorrectAnswer();
    $items[] = $item;
}

// make posts into json and return json data
$postJSON = json_encode($items);
echo $postJSON;

?>
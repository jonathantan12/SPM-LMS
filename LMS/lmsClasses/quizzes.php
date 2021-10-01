<?php
  class quizzes{
    private $quiz_id;
    private $section_id;
    private $question;
    private $question_type;
    private $number_of_options;
    private $correct_answer;

    public function __construct($quiz_id, $section_id, $question, $question_type, $number_of_options, $correct_answer) {
        $this->quiz_id = $quiz_id;
        $this->section_id = $section_id;
        $this->question = $question;
        $this->question_type = $question_type;
        $this->number_of_options = $number_of_options;
        $this->correct_answer = $correct_answer;
    }

    public function getQuizId() {
        return $this->quiz_id;
    }

    public function getSectionId() {
      return $this->section_id;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function getQuestionType() {
        return $this->question_type;
    }

    public function getNumberOfOptions() {
        return $this->number_of_options;
    }

    public function getCorrectAnswer() {
        return $this->correct_answer;
    }
}
?>
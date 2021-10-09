<?php
  class quizzes{
    private $course_id;
    private $section_id;
    private $quiz_id;
    private $question_no;
    private $question;
    private $number_of_options;
    private $correct_answer;

    public function __construct($course_id, $section_id, $quiz_id, $question_no, $question, $number_of_options, $correct_answer) {
        $this->course_id = $course_id;
        $this->section_id = $section_id;
        $this->quiz_id = $quiz_id;
        $this->question_no = $question_no;
        $this->question = $question;
        $this->number_of_options = $number_of_options;
        $this->correct_answer = $correct_answer;
    }

    public function getCourseId(){
        return $this->course_id;
    }

    public function getSectionId() {
        return $this->section_id;
      }

    public function getQuizId() {
        return $this->quiz_id;
    }

    public function getQuestionNo() {
        return $this->question_no;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function getNumberOfOptions() {
        return $this->number_of_options;
    }

    public function getCorrectAnswer() {
        return $this->correct_answer;
    }
}
?>
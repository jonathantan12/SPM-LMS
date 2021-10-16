<?php
  class quizzes{
    private $course_id;
    private $course_class_id;
    private $section_id;
    private $quiz_id;
    private $quiz_title;
    private $quiz_type;
    private $question_no;
    private $question;
    private $number_of_options;
    private $options_content;
    private $correct_answer;

    public function __construct($course_id, $course_class_id, $section_id, $quiz_id, $quiz_title, $quiz_type, $question_no, $question, $number_of_options, $options_content, $correct_answer) {
        $this->course_id = $course_id;
        $this->course_class_id = $course_class_id;
        $this->section_id = $section_id;
        $this->quiz_id = $quiz_id;
        $this->quiz_title = $quiz_title;
        $this->quiz_type = $quiz_type;
        $this->question_no = $question_no;
        $this->question = $question;
        $this->number_of_options = $number_of_options;
        $this->options_content = $options_content;
        $this->correct_answer = $correct_answer;
    }

    public function getCourseId(){
        return $this->course_id;
    }

    public function getCourseClassId(){
        return $this->course_class_id;
    }

    public function getSectionId() {
        return $this->section_id;
      }

    public function getQuizId() {
        return $this->quiz_id;
    }

    public function getQuizTitle() {
        return $this->quiz_title;
    }

    public function getQuizType() {
        return $this->quiz_type;
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

    public function getOptionsContent() {
        return $this->options_content;
    }

    public function getCorrectAnswer() {
        return $this->correct_answer;
    }
}
?>
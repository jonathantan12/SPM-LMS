<?php
  class sectionProgress{
    private $section_progress_id;
    private $user_id;
    private $user_name;
    private $course_id;
    private $course_name;
    private $class_name;
    private $section_id;
    private $section_completion_status;
    private $quiz_completion_status;

    public function __construct($section_progress_id, $user_id, $user_name, $course_id, $course_name, $class_name, $section_id, $section_completion_status, $quiz_completion_status) {
        $this->section_progress_id = $section_progress_id;
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->course_id = $course_id;
        $this->course_name = $course_name;
        $this->class_name = $class_name;
        $this->section_id = $section_id;
        $this->section_completion_status = $section_completion_status;
        $this->quiz_completion_status = $quiz_completion_status;

    }

    public function getSectionProgressId() {
        return $this->section_progress_id;
    }

    public function getUserId() {
      return $this->user_id;
    }

    public function getUserName() {
        return $this->user_name;
    }

    public function getCourseId() {
        return $this->course_id;
    }

    public function getCourseName() {
        return $this->course_name;
    }

    public function getClassName() {
        return $this->class_name;
    }

    public function getSectionId() {
        return $this->section_id;
    }

    public function getSectionCompletionStatus() {
        return $this->section_completion_status;
    }

    public function getQuizCompletionStatus() {
        return $this->quiz_completion_status;
    }
}
?>
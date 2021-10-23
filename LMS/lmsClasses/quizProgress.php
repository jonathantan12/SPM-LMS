<?php
  class quizProgress{
    private $user_id;
    private $course_id;
    private $course_class_id;
    private $section_id;
    private $completion_status;
    

    public function __construct($user_id, $course_id, $course_class_id, $section_id, $completion_status) {
        $this->user_id = $user_id;
        $this->course_id = $course_id;
        $this->course_class_id = $course_class_id;
        $this->section_id = $section_id;
        $this->completion_status = $completion_status;
       
    }

    public function getUserId(){
        return $this->user_id;
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

    public function getCompletionStatus() {
        return $this->completion_status;
    }
    
}
?>
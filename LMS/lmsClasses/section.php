<?php
  class section{
    private $section_id;
    private $course_id;
    private $course_class_id;
    private $section_title;

    // constructor
    public function __construct($section_id, $course_id, $course_class_id, $section_title) {
        $this->section_id = $section_id;
        $this->course_id = $course_id;
        $this->course_class_id = $course_class_id;
        $this->section_title = $section_title;
    }

    public function getSectionId() {
        return $this->section_id;
    }

    public function getCourseId() {
      return $this->course_id;
    }

    public function getCourseClassId() {
        return $this->course_class_id;
    }

    public function getSectionTitle() {
        return $this->section_title;
    }
    
  
   
}
?>
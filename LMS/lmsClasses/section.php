<?php
  class section{
    private $section_id;
    private $course_id;
    private $section_title;
    private $order;

    // constructor
    public function __construct($section_id, $course_id, $section_title, $order) {
        $this->section_id = $section_id;
        $this->course_id = $course_id;
        $this->section_title = $section_title;
        $this ->order = $order;
    }

    public function getSectionId() {
        return $this->section_id;
    }

    public function getCourseId() {
      return $this->course_id;
    }

    public function getSectionTitle() {
        return $this->section_title;
    }
    
    public function getOrder() {
        return $this->order;
    }
   
}
?>
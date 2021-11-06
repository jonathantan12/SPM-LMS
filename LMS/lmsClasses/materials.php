<?php
  class materials{
    private $course_id;
    private $course_class_id;
    private $section_id;
    private $material_id;
    private $material_name;
    private $material_url;
    private $completion_status;

    public function __construct($course_id, $course_class_id, $section_id, $material_id, $material_name, $material_url, $completion_status) {
        $this->course_id = $course_id;
        $this->course_class_id = $course_class_id;
        $this->section_id = $section_id;
        $this->material_id = $material_id;
        $this->material_name = $material_name;
        $this->material_url = $material_url;
        $this->completion_status = $completion_status;
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

    public function getMaterialId() {
        return $this->material_id;
    }

    public function getMaterialName() {
        return $this->material_name;
    }

    public function getMaterialUrl() {
        return $this->material_url;
    }

    public function getCompletionStatus() {
        return $this->completion_status;
    }
}
?>
<?php
  class sections{
    private $section_id;
    private $course_id;
    private $course_name;
    private $class_name;
    private $course_section_number;
    private $section_name;
    private $course_material_link;

    public function __construct($section_id, $course_id, $course_name, $class_name, $course_section_number, $section_name, $course_material_link) {
        $this->section_id = $section_id;
        $this->course_id = $course_id;
        $this->course_name = $course_name;
        $this->class_name = $class_name;
        $this->course_section_number = $course_section_number;
        $this->section_name = $section_name;
        $this->course_material_link = $course_material_link;
      
    }

    public function getSectionId() {
        return $this->section_id;
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

    public function getCourseSectionNumber() {
        return $this->course_section_number;
    }

    public function getSectionName() {
        return $this->section_name;
    }

    public function getCourseMaterialLink() {
        return $this->course_material_link;
    }
}
?>
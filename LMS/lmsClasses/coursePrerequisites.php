<?php
  class coursePrerequisites{
    private $id;
    private $course_id;
    private $course_name;
    private $prerequisite_course_id;
    private $prerequisite_course_name;

    public function __construct($id, $course_id, $course_name, $prerequisite_course_id, $prerequisite_course_name) {
        $this->id = $id;
        $this->course_id = $course_id;
        $this->course_name = $course_name;
        $this->prerequisite_course_id = $prerequisite_course_id;
        $this->prerequisite_course_name = $prerequisite_course_name;
    }

    public function getId() {
        return $this->id;
    }

    public function getCourseId() {
      return $this->course_id;
    }

    public function getCourseName() {
      return $this->course_name;
    }

    public function getPrerequisiteCourseId() {
      return $this->prerequisite_course_id;
    }

    public function getPrerequisiteCourseName() {
      return $this->prerequisite_course_name;
    }

}
?>
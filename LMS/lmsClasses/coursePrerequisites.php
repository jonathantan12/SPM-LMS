<?php
  class coursePrerequisites{
    private $id;
    private $course_id;
    private $prerequisites_course_id;

    public function __construct($id, $course_id, $prerequisites_course_id) {
        $this->id = $id;
        $this->course_id = $course_id;
        $this->$prerequisites_course_id = $prerequisites_course_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getCourseId() {
      return $this->course_id;
    }

    public function getPrerequisitesCourseId() {
      return $this->prerequisites_course_id;
    }

}
?>
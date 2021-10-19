<?php
  class courses{
    private $course_id;
    private $course_name;
    private $course_desc;
    private $image;

    public function __construct($course_id, $course_name, $course_desc, $image) {
        $this->course_id = $course_id;
        $this->course_name = $course_name;
        $this->course_desc = $course_desc;
        $this->image = $image;
    }

    public function getCourseId() {
      return $this->course_id;
    }

    public function getCourseName() {
        return $this->course_name;
    }

    public function getCourseDesc() {
        return $this->course_desc;
    }

    public function getImage() {
        return $this->image;
    }
}
?>
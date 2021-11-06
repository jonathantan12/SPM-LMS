<?php
  class completedCourses{
    private $completed_course_id;
    private $user_id;
    private $user_name;
    private $course_id;
    private $course_name;
    private $image;

    public function __construct($completed_course_id, $user_id, $user_name, $course_id, $course_name, $image) {
        $this->completed_course_id = $completed_course_id;
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->course_id = $course_id;
        $this->course_name = $course_name;
        $this->image = $image;
    }

    public function getCompletedCourseId() {
        return $this->completed_course_id;
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

    public function getImage() {
      return $this->image;
    }

}
?>
<?php
  class courseTrainers{
    private $course_trainer_id;  
    private $course_id;
    private $course_name;
    private $user_id;
    private $user_name;

    public function __construct($course_trainer_id, $course_id, $course_name, $user_id, $user_name) {
        $this->course_trainer_id = $course_trainer_id;
        $this->course_id = $course_id;
        $this->course_name = $course_name;
        $this->user_id = $user_id;
        $this->user_name = $user_name;
    }

    public function getCourseTrainerId() {
        return $this->course_trainer_id;
    }

    public function getCourseId() {
      return $this->course_id;
    }

    public function getCourseName() {
      return $this->course_name;
    }

    public function getUserId() {
      return $this->user_id;
    }

    public function getUserName() {
      return $this->user_name;
    }



}
?>
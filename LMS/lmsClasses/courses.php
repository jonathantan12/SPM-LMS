<?php
  class courses{
    private $course_id;
    private $course_name;
    private $course_desc;
    private $class_name;
    private $start_date;
    private $end_date;
    private $slots_available;
    private $trainer_id;
    private $trainer_name;
    private $image;

    public function __construct($course_id, $course_name, $course_desc, $class_name, $start_date, $end_date, $slots_available, $trainer_id, $trainer_name,$image) {
        $this->course_id = $course_id;
        $this->course_name = $course_name;
        $this->course_desc = $course_desc;
        $this->class_name = $class_name;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->slots_available = $slots_available;
        $this->trainer_id = $trainer_id;
        $this->trainer_name = $trainer_name;
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

    public function getClassName() {
        return $this->class_name;
    }

    public function getStartDate() {
        return $this->start_date;
    }

    public function getEndDate() {
        return $this->end_date;
    }

    public function getSlotsAvailable() {
        return $this->slots_available;
    }

    public function getTrainerId() {
        return $this->trainer_id;
    }

    public function getTrainerName() {
        return $this->trainer_name;
    }

    public function getImage() {
        return $this->image;
    }
}
?>
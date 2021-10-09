<?php
    require_once('common.php');
    $requiredCoursesDAO = new requiredCoursesDAO;
    $coursesDAO = new coursesDAO;
    $courses = $coursesDAO->getCourses();

    $items = [];

// this returns all users and their required courses to take
    foreach ( $courses as $course ) {
        if (!array_key_exists($course->getCourseId(), $items)) {
            $item["course_id"] = $course->getCourseId();
            $eligible_learners = $requiredCoursesDAO->getEligibleLearners($course->getCourseId());
            $learners = [];
            foreach ($eligible_learners as $eligible_learner) {
                $learner["user_id"] = $eligible_learner->getUserId();
                $learner["user_name"] = $eligible_learner->getUserName();
                $learners[] = $learner;
            }
            $item["learners"] = $learners;
            $items[$course->getCourseName()] = $item;
        }
    }
    
    $postJSON = json_encode($items);
    echo $postJSON;
?>
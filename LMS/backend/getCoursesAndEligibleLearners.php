<?php
    require_once('common.php');
    $requiredCoursesDAO = new requiredCoursesDAO;
    $coursesDAO = new coursesDAO;
    $completedCoursesDAO = new completedCoursesDAO;
    $coursePrerequisites = new coursePrerequisitesDAO;
    $courses = $coursesDAO->getCourses();

    $items = [];

// this returns all users and their required courses to take
    foreach ( $courses as $course ) {
        if (!array_key_exists($course->getCourseId(), $items)) {
            $item["course_id"] = $course->getCourseId();
            $prerequisites = $coursePrerequisites->getCoursePrerequisites($course->getCourseId());
            $eligible_learners = $requiredCoursesDAO->getEligibleLearners($course->getCourseId());
            $learners = [];
            foreach ($eligible_learners as $eligible_learner) {
                $completedCourses = $completedCoursesDAO->getCompletedCourses($eligible_learner->getUserId());
                $completed_id_list = [];

                // compile completed course id into an array for easy retrieval
                foreach ($completedCourses as $completedCourse) {
                    $completed_id = $completedCourse->getCourseId();
                    $completed_id_list[] = $completed_id;
                }

                $check = 1;
                foreach ($prerequisites as $prerequisite) {
                    $pre_id = $prerequisite->getPrerequisiteCourseId();
                    if (!in_array($pre_id, $completed_id_list)) {
                        $check = 0;
                    }
                }

                if ($check == 1) {
                    $learner["user_id"] = $eligible_learner->getUserId();
                    $learner["user_name"] = $eligible_learner->getUserName();
                    $learners[] = $learner;
                }
            }
            $item["learners"] = $learners;
            $items[$course->getCourseName()] = $item;
        }
    }
    
    $postJSON = json_encode($items);
    echo $postJSON;
?>
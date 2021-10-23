<?php
    require_once('common.php');
    $usersDAO = new usersDAO;
    $requiredCoursesDAO = new RequiredCoursesDAO;
    $completedCoursesDAO = new completedCoursesDAO;
    $coursePrerequisites = new coursePrerequisitesDAO;
    $users = $usersDAO->getUsers("engineer");

    $items = [];

// this returns all users and their required courses to take
    foreach ( $users as $user ) {
        $item["user_id"] = $user->getUserId();
        $required_courses = $requiredCoursesDAO->getRequiredCourses($user->getUserId());
        $completedCourses = $completedCoursesDAO->getCompletedCourses($user->getUserId());
        $completed_id_list = [];

        // compile completed course id into an array for easy retrieval
        foreach ($completedCourses as $completedCourse) {
            $completed_id = $completedCourse->getCourseId();
            $completed_id_list[] = $completed_id;
        }

        $courses = [];
        foreach ($required_courses as $required_course) {
            #do if else here to check if prerequisites are cleared for required courses
            $prerequisites = $coursePrerequisites->getCoursePrerequisites($required_course->getCourseId());
            $check = 1;
            foreach ($prerequisites as $prerequisite) {
                $pre_id = $prerequisite->getPrerequisiteCourseId();
                if (!in_array($pre_id, $completed_id_list)) {
                    $check = 0;
                }
            }

            // prerequisites all fulfilled
            if ($check == 1) {
                $course["course_id"] = $required_course->getCourseId();
                $course["course_name"] = $required_course->getCourseName();
                $courses[] = $course;
            }
        }
        $item["courses"] = $courses;
        $items[$user->getUserName()] = $item;
    }
    
    $postJSON = json_encode($items);
    echo $postJSON;
?>
<?php
    require_once('common.php');
    $usersDAO = new usersDAO;
    $requiredCoursesDAO = new requiredCoursesDAO;
    $users = $usersDAO->getUsers("engineer");

    $items = [];

// this returns all users and their required courses to take
    foreach ( $users as $user ) {
        $item["user_id"] = $user->getUserId();
        $required_courses = $requiredCoursesDAO->getRequiredCourses($user->getUserId());
        $courses = [];
        foreach ($required_courses as $required_course) {
            $course["course_id"] = $required_course->getCourseId();
            $course["course_name"] = $required_course->getCourseName();
            $courses[] = $course;
        }
        $item["courses"] = $courses;
        $items[$user->getUserName()] = $item;
    }
    
    $postJSON = json_encode($items);
    echo $postJSON;
?>
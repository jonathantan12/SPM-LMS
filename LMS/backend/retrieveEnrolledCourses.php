<?php
    // header("Access-Control-Allow-Origin: *");
    // header("Content-Type: application/json; charset=UTF-8");
    require_once "common.php";

    // initialize object
    $enrolledCoursesDb = new EnrolledCoursesDAO();

    $testUserId = 1;
    // query products
    $enrolledCourses = $enrolledCoursesDb->getEnrolledCourses($testUserId);

    // check if more than 0 record found
    if($enrolledCourses) {

        // products array
        $result_arr = array();

        foreach($enrolledCourses as $enrolledCourse) {
            
            $item = array(
                            "enrolled_course_id" => $enrolledCourse->getEnrolledCourseId(),            
                            "user_id" => $enrolledCourse->getUserId(),
                            "user_name" => $enrolledCourse->getUserName(),
                            "course_id" => $enrolledCourse->getCourseId(),
                            "course_name" => $enrolledCourse->getCourseName()
                        );

            $result_arr[] = $item;
        };
    

        // set response code - 200 OK
        http_response_code(200);

        // show products data in json format
        echo json_encode($result_arr);
    }
    else {
    
        // set response code - 404 Not found
        http_response_code(404);
    
        // tell the user no items found
        echo json_encode(
            array("message" => "No records found.")
        );
    }


?>
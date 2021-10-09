<?php
    // header("Access-Control-Allow-Origin: *");
    // header("Content-Type: application/json; charset=UTF-8");
    require_once "common.php";

    // initialize object
    $coursesDb = new CoursesDAO();

    // query products
    $courses = $coursesDb->getCourses();

    // check if more than 0 record found
    if($courses) {

        // products array
        $result_arr = array();

        foreach($courses as $course) {
            
            $item = array(
                            "course_id" => $course->getCourseId(),            
                            "course_name" => $course->getCourseName(),
                            "course_desc" => $course->getCourseDesc(),
                            "class_number" => $course->getClassName(),
                            "start_date" => $course->getStartDate(),
                            "end_date" => $course->getEndDate(),
                            "slots_available" => $course->getSlotsAvailable(),
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
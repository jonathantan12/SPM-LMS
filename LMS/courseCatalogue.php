<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    require_once("lmsClasses/autoload.php");

    // instantiate database and product object
    $connmng = new ConnectionManager();
    $db = $connmng->getConnection();

    // initialize object
    $coursesdb = new CourseDAO($db);

    // query products
    $stmtRest = $coursesdb->getAll();
    $numRest = $stmtRest->rowCount();

    // check if more than 0 record found
    if($numRest > 0) {

        // products array
        $result_arr = array();

        while( $rowRest = $stmtRest->fetch(PDO::FETCH_ASSOC) ) {
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($rowRest);

            $item = array(
                            "course_id" => $course_id,            
                            "course_name" => $course_name,
                            "course_desc" => $course_desc,
                            "class_number" => $class_number,
                            "start_date" => $start_date,
                            "end_date" => $end_date,
                            "slots_available" => $slots_available,
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
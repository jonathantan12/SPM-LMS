<?php
    require_once('common.php');
    $dao = new ClassesDAO();
    
    $course_id = $_GET['courseId'];
    $classes = $dao->getClassesWithVacancy((int)$course_id);

    #this returns the first class with vacancy
    $check = 0;
    foreach ( $classes as $class ) {
        $vacancy = $class->getSlotsAvailable();
        if ($vacancy != 0) {
            $check = 1;
            echo $class->getClassName();
            break;
        }
    }
    
    if ($check == 0) {
        echo "no classes available for the chosen course";
    }
    

    
?>
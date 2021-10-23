<?php

class enrolledCoursesTest extends \PHPUnit\Framework\TestCase
{
    public function testGetName() {
        # require '../lmsClasses/enrolledCourses.php';
        # require '../lmsClasses/EnrolledCoursesDAO.php';
        # require '../lmsClasses/connectionManager.php';

        $enrolled_course_id = 1;
        $user_id = 1;
        $user_name = 'Roger';
        $course_id = 1;
        $course_name = 'Introduction';

        $enrolledCourses = new enrolledCourses($enrolled_course_id, $user_id, $user_name, $course_id, $course_name);

        $enrolledCourses->getEnrolledCourseId();

        $this->assertEquals($enrolledCourses->getEnrolledCourseId(), 1);
        # $enrolledCourses = $enrolledCoursesDAO->getEnrolledCourses(1);
        # $this->assetEquals(, $enrolledCourses);
    }
}

?>
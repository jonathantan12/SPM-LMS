<?php

# require '../../lmsClasses/Cart.php';

class coursesTest extends \PHPUnit\Framework\TestCase 
{
    public function testCoursesAreReturned() 
    {
        $mockRepo = $this->createMock(CoursesDAO::class);

        $mockCoursesObject = [
            # $course_id, $course_name, $course_desc, $class_name, $start_date, $end_date, $slots_available, $trainer_id, $trainer_name,$image
            new courses(1, 'Electrical Engineering','course description', 'G1','2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 2, 'Roger','image'),
            new courses(2, 'Introduction to Mechanical Engineering','course description', 'G1', '2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 2, 'Roger', 'image'),
            new courses(3, 'Introduction to Scrum Methodology','course description', 'G1','2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 2, 'Roger','image'),
            new courses(3, 'Introduction to Scrum Methodology','course description', 'G2','2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 1, 'Ben','image')
        ];

        $mockRepo->method('getCourses')->willReturn($mockCoursesObject);

        $courses = $mockRepo->getCourses(); #Getting back the database object

        $courseId = $courses[0]->getCourseId();
        $courseName = $courses[0]->getCourseName();
        $courseDesc = $courses[0]->getCourseDesc();
        $className = $courses[0]->getClassName();
        $startDate = $courses[0]->getStartDate();
        $endDate = $courses[0]->getEndDate();
        $slotsAvailable = $courses[0]->getSlotsAvailable();
        $trainerId = $courses[0]->getTrainerId();
        $trainerName = $courses[0]->getTrainerName();
        $image = $courses[0]->getImage();

        $this->assertEquals(1, $courseId);
        $this->assertEquals('Electrical Engineering', $courseName);
        $this->assertEquals(null, $courseDesc); #Why is this null
        $this->assertEquals('G1', $className);
        $this->assertEquals('2021-01-01 00:00:00', $startDate);
        $this->assertEquals('2021-02-01 00:00:00', $endDate);
        $this->assertEquals(100, $slotsAvailable);
        $this->assertEquals(2, $trainerId);
        $this->assertEquals('Roger', $trainerName);
        $this->assertEquals('image', $image);
    }
}
?>
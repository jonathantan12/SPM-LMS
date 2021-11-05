<?php

# junlong.toh.2019


class classesTest extends \PHPUnit\Framework\TestCase 
{
    public function testClassesAreReturned() 
    {
        $mockRepo = $this->createMock(ClassesDAO::class);

        $mockClassesObject = [
            new classes(1, 'Electrical Engineering I', 'G2','2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 5, 'Ben'),
            new classes(5, 'Introduction to Mechanical Engineering II', 'G1', '2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 2, 'Roger'),
            new classes(8, 'Introduction to Scrum Methodology II', 'G1','2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 6, 'Aaron')
        ];

        $mockRepo->method('getClassesWithVacancy')->willReturn($mockClassesObject);

        
        $classes = $mockRepo->getClassesWithVacancy(1); #Getting back the database object

        $courseId = $classes[0]->getCourseId();
        $courseName = $classes[0]->getCourseName();
        $className = $classes[0]->getClassName();
        $startDate = $classes[0]->getStartDate();
        $endDate = $classes[0]->getEndDate();
        $slotsAvailable = $classes[0]->getSlotsAvailable();
        $trainerId = $classes[0]->getTrainerId();
        $trainerName = $classes[0]->getTrainerName();

        $this->assertEquals(1, $courseId);
        $this->assertEquals('Electrical Engineering I', $courseName);
        $this->assertEquals('G2', $className);
        $this->assertEquals('2021-01-01 00:00:00', $startDate);
        $this->assertEquals('2021-02-01 00:00:00', $endDate);
        $this->assertEquals(100, $slotsAvailable);
        $this->assertEquals(5, $trainerId);
        $this->assertEquals('Ben', $trainerName);
    }
}

?>
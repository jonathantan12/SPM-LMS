<?php

# jjtan.2019

class coursesTest extends \PHPUnit\Framework\TestCase 
{
    public function testCoursesAreReturned() 
    {
        $mockRepo = $this->createMock(CoursesDAO::class);

        $mockCoursesObject = [
            new courses(1, 'Electrical Engineering I','Electrical engineering deals with the study and application of physics and mathematics combined with elements of electricity, electronics, and electromagnetism to both large and small scale systems to process information and transmit energy.', 'assets/Electrical1.jpg'),
            new courses(2, 'Electrical Engineering II','Electrical engineering deals with the study and application of physics and mathematics combined with elements of electricity, electronics, and electromagnetism to both large and small scale systems to process information and transmit energy.', 'assets/Electrical2.jpg'),
            new courses(3, 'Electrical Engineering III','Electrical engineering deals with the study and application of physics and mathematics combined with elements of electricity, electronics, and electromagnetism to both large and small scale systems to process information and transmit energy.', 'assets/Electrical3.jpg'),
            new courses(4, 'Introduction to Mechanical Engineering I','Mechanical engineering is an engineering branch that combines engineering physics and mathematics principles with materials science to design, analyze, manufacture, and maintain mechanical systems.', 'assets/MechanicalEngineering1.jpg'),
            new courses(5, 'Introduction to Mechanical Engineering II','Mechanical engineering is an engineering branch that combines engineering physics and mathematics principles with materials science to design, analyze, manufacture, and maintain mechanical systems.', 'assets/MechanicalEngineering2.jpg'),
            new courses(6, 'Introduction to Mechanical Engineering III','Mechanical engineering is an engineering branch that combines engineering physics and mathematics principles with materials science to design, analyze, manufacture, and maintain mechanical systems.', 'assets/MechanicalEngineering3.jpg'),
            new courses(7, 'Introduction to Scrum Methodology I','Scrum is a framework for developing, delivering, and sustaining products in a complex environment, with an initial emphasis on software development, although it has been used in other fields including research, sales, marketing and advanced technologies.', 'assets/Scrum1.jpg'),
            new courses(8, 'Introduction to Scrum Methodology II','Scrum is a framework for developing, delivering, and sustaining products in a complex environment, with an initial emphasis on software development, although it has been used in other fields including research, sales, marketing and advanced technologies.', 'assets/Scrum2.jpg'),
            new courses(9, 'Introduction to Scrum Methodology III','Scrum is a framework for developing, delivering, and sustaining products in a complex environment, with an initial emphasis on software development, although it has been used in other fields including research, sales, marketing and advanced technologies.', 'assets/Scrum3.jpg')
        ];
        
        $mockRepo->method('getCourses')->willReturn($mockCoursesObject);

        $courses = $mockRepo->getCourses(); #Getting back the database object

        $courseId = $courses[0]->getCourseId();
        $courseName = $courses[0]->getCourseName();
        $courseDesc = $courses[0]->getCourseDesc();
        $image = $courses[0]->getImage();

        $this->assertEquals(1, $courseId);
        $this->assertEquals('Electrical Engineering I', $courseName);
        $this->assertEquals('Electrical engineering deals with the study and application of physics and mathematics combined with elements of electricity, electronics, and electromagnetism to both large and small scale systems to process information and transmit energy.', $courseDesc); #Why is this null
        $this->assertEquals('assets/Electrical1.jpg', $image);
    }
}
?>
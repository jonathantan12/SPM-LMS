<?php



class quizzesTest extends \PHPUnit\Framework\TestCase 
{
    public function testQuizzesAreReturned() 
    {
        $mockRepo = $this->createMock(quizzesDAO::class);

        $mockQuizzesObject = [
            # $course_id, $course_class_id, $section_id, $quiz_id, $quiz_title, $quiz_type, $question_no, $question, $number_of_options,$options_content,$correct_answer
            new quizzes(1, 1, 1, 1,'quiz title 1','graded',1,'Is it true that it is like this?', 2, 'true,false','true'),
            new quizzes(1, 1, 1, 1,'quiz title 2','ungraded',2,'Is it true that it is like this?', 2, 'true,false','false'),
            new quizzes(1, 1, 1, 1,'quiz title 3','graded',3,'Is it true that it is like this?', 2, 'true,false','false')
            
        ];

        $mockRepo->method('getQuizzes')->willReturn($mockQuizzesObject);

        $quizzes = $mockRepo->getQuizzes(1,1,1,1); #Getting back the database object

        $courseId = $quizzes[0]->getCourseId();
        $courseClassId = $quizzes[0]->getCourseClassId();
        $sectionId = $quizzes[0]->getSectionId();
        $quizId = $quizzes[0]->getQuizId();
        $quizTitle = $quizzes[0]->getQuizTitle();
        $quizType = $quizzes[0]->getQuizType();
        $questionNo = $quizzes[0]->getQuestionNo();
        $question = $quizzes[0]->getQuestion();
        $numberOfOptions = $quizzes[0]->getNumberOfOptions();
        $optionsContent = $quizzes[0]->getOptionsContent();
        $correctAnswer = $quizzes[0]->getCorrectAnswer();

        $this->assertEquals(1, $courseId);
        $this->assertEquals(1, $courseClassId);
        $this->assertEquals(1, $sectionId); #Why is this null
        $this->assertEquals(1, $quizId);
        $this->assertEquals('quiz title 1', $quizTitle);
        $this->assertEquals('graded', $quizType);
        $this->assertEquals(1, $questionNo);
        $this->assertEquals('Is it true that it is like this?', $question);
        $this->assertEquals(2, $numberOfOptions);
        $this->assertEquals('true,false', $optionsContent);
        $this->assertEquals('true', $correctAnswer);
    }
}
?>
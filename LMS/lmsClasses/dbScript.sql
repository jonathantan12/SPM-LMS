SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `LMS` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `LMS`;

--
-- USERS table
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
    `user_id` int(64) NOT NULL AUTO_INCREMENT,
    `user_name` varchar(64) NOT NULL,
    `user_role` varchar(64) NOT NULL,
    `login_id` varchar(64) NOT NULL,
    `login_password` varchar(64) NOT NULL,
    PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_role`, `login_id`, `login_password`) VALUES
(1, 'Jonathan','engineer', 'test1@gmail.com', '0000'),
(2, 'Roger','trainer', 'test2@gmail.com', '0000'),
(3, 'Betty','administrator', 'test3@gmail.com', '0000'),
(4, 'Kelly','engineer', 'test4@gmail.com', '0000'),
(5, 'Ben','trainer', 'test5@gmail.com', '0000'),
(6, 'Aaron','trainer', 'test6@gmail.com', '0000');

COMMIT;


--
-- COURSES table
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
    `course_id` int(64) NOT NULL AUTO_INCREMENT,
    `course_name` varchar(64) NOT NULL,
    `course_desc` varchar(64) NOT NULL,
    `image` varchar(64),
    PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_desc`, `image`) VALUES
(1, 'Electrical Engineering I','course description', 'image'),
(2, 'Electrical Engineering II','course description', 'image'),
(3, 'Electrical Engineering III','course description', 'image'),
(4, 'Introduction to Mechanical Engineering I','course description', 'image'),
(5, 'Introduction to Mechanical Engineering II','course description', 'image'),
(6, 'Introduction to Mechanical Engineering III','course description', 'image'),
(7, 'Introduction to Scrum Methodology I','course description', 'image'),
(8, 'Introduction to Scrum Methodology II','course description', 'image'),
(9, 'Introduction to Scrum Methodology III','course description', 'image');

COMMIT;

--
-- COURSE_PREREQUISITES table
--

DROP TABLE IF EXISTS `course_prerequisites`;
CREATE TABLE IF NOT EXISTS `course_prerequisites` (
    `id` int(64) NOT NULL AUTO_INCREMENT,
    `course_id` int(64) NOT NULL,
    `course_name` varchar(64) NOT NULL,
    `prerequisite_course_id` int(64) NOT NULL,
    `prerequisite_course_name` varchar(64) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_prerequisites`
--

INSERT INTO `course_prerequisites` (`id`, `course_id`, `course_name`,`prerequisite_course_id`, `prerequisite_course_name`) VALUES
(1, 2, 'Electrical Engineering II', 1, 'Electrical Engineering I'),
(2, 3, 'Electrical Engineering III', 1, 'Electrical Engineering I'),
(3, 3, 'Electrical Engineering III', 2, 'Electrical Engineering II'),
(4, 5, 'Introduction to Mechanical Engineering II', 4, 'Introduction to Mechanical Engineering I'),
(5, 6, 'Introduction to Mechanical Engineering III', 4, 'Introduction to Mechanical Engineering I'),
(6, 6, 'Introduction to Mechanical Engineering III', 5, 'Introduction to Mechanical Engineering II'),
(7, 8, 'Introduction to Scrum Methodology II', 7, 'Introduction to Scrum Methodology I'),
(8, 9, 'Introduction to Scrum Methodology III', 7, 'Introduction to Scrum Methodology I'),
(9, 9, 'Introduction to Scrum Methodology III', 8, 'Introduction to Scrum Methodology II');

COMMIT;

--
-- CLASSES table
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
    `course_id` int(64) NOT NULL ,
    `course_name` varchar(64) NOT NULL,
    `class_name` varchar(64) NOT NULL,
    `start_date` DATETIME NOT NULL,
    `end_date` DATETIME NOT NULL,
    `slots_available` int(64) NOT NULL,
    `trainer_id` int(64) NOT NULL,
    `trainer_name` varchar(64) NOT NULL, 
    PRIMARY KEY (`course_id`, `class_name`),
    FOREIGN KEY (trainer_id) REFERENCES users(user_id)
);

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`course_id`, `course_name`, `class_name`,`start_date`, `end_date`, `slots_available`, `trainer_id`, `trainer_name`) VALUES
(1, 'Electrical Engineering I', 'G1','2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 2, 'Roger'),
(2, 'Electrical Engineering II', 'G1','2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 5, 'Ben'),
(3, 'Electrical Engineering III', 'G1','2021-01-01 00:00:00', '2021-02-01 00:00:00', 0, 5, 'Ben'),
(3, 'Electrical Engineering III', 'G2','2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 2, 'Roger'),
(4, 'Introduction to Mechanical Engineering I', 'G1', '2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 2, 'Roger'),
(5, 'Introduction to Mechanical Engineering II', 'G1', '2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 2, 'Roger'),
(6, 'Introduction to Mechanical Engineering III', 'G1', '2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 6, 'Aaron'),
(7, 'Introduction to Scrum Methodology I', 'G1','2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 2, 'Roger'),
(8, 'Introduction to Scrum Methodology II', 'G1','2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 6, 'Aaron'),
(9, 'Introduction to Scrum Methodology II', 'G1','2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 6, 'Aaron');

COMMIT;


-- SECTION table (just section)
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
    `section_id` int(64) NOT NULL AUTO_INCREMENT, 
    `course_id` int(64) NOT NULL,
    `section_title` varchar(64) NOT NULL,
    `order` int(11) NOT NULL,
    PRIMARY KEY (`section_id`),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `course_id`, `section_title`, `order`) VALUES
(1, 1, 'Electrical Engineering 1',  1 ),
(2, 1, 'Electrical Engineering 2',  2 ),
(3, 1, 'Electrical Engineering 3',  3 );
COMMIT;

--
-- SECTIONS table
--

DROP TABLE IF EXISTS `sections`;
CREATE TABLE IF NOT EXISTS `sections` (
    `section_id` int(64) NOT NULL AUTO_INCREMENT, 
    `course_id` int(64) NOT NULL,
    `course_name` varchar(64) NOT NULL,
    `class_name` varchar(64) NOT NULL,
    `course_section_number` int(64) NOT NULL,
    `section_name` varchar(64) NOT NULL,
    `course_material_link` varchar(64) NOT NULL,
    PRIMARY KEY (`section_id`),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `course_id`, `course_name`, `class_name`,`course_section_number`, `section_name`, `course_material_link`) VALUES
(1, 1, 'Electrical Engineering', 'G1', 1, 'Introduction','url'),
(2, 1, 'Electrical Engineering', 'G2', 1, 'Introduction','url'),
(3, 1, 'Electrical Engineering', 'G1', 2, 'The Second Chapter','url');
COMMIT;


--
-- TRAINER_QUALIFICATION table
--

DROP TABLE IF EXISTS `trainer_qualifications`;
CREATE TABLE IF NOT EXISTS `trainer_qualifications` (
    `trainer_qualification_id` int(64) NOT NULL AUTO_INCREMENT, 
    `user_id` int(64) NOT NULL,
    `user_name` varchar(64) NOT NULL,
    `course_id` int(64) NOT NULL,
    `course_name` varchar(64) NOT NULL,
    PRIMARY KEY (`trainer_qualification_id`),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainer_qualifications`
--

INSERT INTO `trainer_qualifications` (`trainer_qualification_id`, `user_id`, `user_name`,`course_id`, `course_name`) VALUES
(1, 2, 'Roger', 1, 'Electrical Engineering I'),
(2, 2, 'Roger', 3, 'Electrical Engineering III'),
(3, 2, 'Roger', 4, 'Introduction to Mechanical Engineering I'),
(4, 2, 'Roger', 5, 'Introduction to Mechanical Engineering II'),
(5, 2, 'Roger', 7, 'Introduction to Scrum Methodology I'),
(6, 5, 'Ben', 2, 'Electrical Engineering II'),
(7, 5, 'Ben', 3, 'Electrical Engineering III'),
(8, 6, 'Aaron', 4, 'Introduction to Mechanical Engineering I'),
(9, 6, 'Aaron', 5, 'Introduction to Mechanical Engineering II'),
(10, 6, 'Aaron', 6, 'Introduction to Mechanical Engineering III'),
(11, 6, 'Aaron', 7, 'Introduction to Scrum Methodology I'),
(12, 6, 'Aaron', 8, 'Introduction to Scrum Methodology II'),
(13, 6, 'Aaron', 9, 'Introduction to Scrum Methodology III');

COMMIT;

--
-- COMPLETED_COURSES table
--

DROP TABLE IF EXISTS `completed_courses`;
CREATE TABLE IF NOT EXISTS `completed_courses` (
    `completed_course_id` int(64) NOT NULL AUTO_INCREMENT,
    `user_id` int(64) NOT NULL,
    `user_name` varchar(64) NOT NULL,
    `course_id` int(64) NOT NULL,
    `course_name` varchar(64) NOT NULL,
    PRIMARY KEY (`completed_course_id`),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `completed_courses`
--

INSERT INTO `completed_courses` (`completed_course_id`, `user_id`, `user_name`,`course_id`, `course_name`) VALUES
(1, 1, 'Jonathan', 1, 'Electrical Engineering I'),
(2, 1, 'Jonathan', 2, 'Electrical Engineering II'),
(3, 1, 'Jonathan', 7, 'Introduction to Scrum Methodology I'),
(4, 4, 'Kelly', 1, 'Electrical Engineering I'),
(5, 4, 'Kelly', 4, 'Introduction to Mechanical Engineering I'),
(6, 4, 'Kelly', 7, 'Introduction to Scrum Methodology I');

COMMIT;


--
-- REQUIRED_COURSES table
-- 

DROP TABLE IF EXISTS `required_courses`;
CREATE TABLE IF NOT EXISTS `required_courses` (
    `required_course_id` int(64) NOT NULL AUTO_INCREMENT,
    `user_id` int(64) NOT NULL,
    `user_name` varchar(64) NOT NULL,
    `course_id` int(64) NOT NULL,
    `course_name` varchar(64) NOT NULL,
    PRIMARY KEY (`required_course_id`),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `required_courses`
--

INSERT INTO `required_courses` (`required_course_id`, `user_id`, `user_name`,`course_id`, `course_name`) VALUES
(1, 1, 'Jonathan', 3, 'Electrical Engineering III'),
(2, 1, 'Jonathan', 5, 'Introduction to Mechanical Engineering II'),
(3, 1, 'Jonathan', 6, 'Introduction to Mechanical Engineering III'),
(4, 1, 'Jonathan', 8, 'Introduction to Scrum Methodology II'),
(5, 1, 'Jonathan', 9, 'Introduction to Scrum Methodology III'),
(6, 4, 'Kelly', 3, 'Electrical Engineering III'),
(7, 4, 'Kelly', 6, 'Introduction to Mechanical Engineering III'),
(8, 4, 'Kelly', 8, 'Introduction to Scrum Methodology II'),
(9, 4, 'Kelly', 9, 'Introduction to Scrum Methodology III');

COMMIT;


--
-- ENROLLED_COURSES table
--

DROP TABLE IF EXISTS `enrolled_courses`;
CREATE TABLE IF NOT EXISTS `enrolled_courses` (
    `enrolled_course_id` int(64) NOT NULL AUTO_INCREMENT,
    `user_id` int(64) NOT NULL,
    `user_name` varchar(64) NOT NULL,
    `course_id` int(64) NOT NULL,
    `course_name` varchar(64) NOT NULL,
    `class_name` varchar(64) NOT NULL,
    PRIMARY KEY (`enrolled_course_id`),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enrolled_courses`
--

INSERT INTO `enrolled_courses` (`enrolled_course_id`, `user_id`, `user_name`,`course_id`, `course_name`, `class_name`) VALUES
(1, 1, 'Jonathan', 4, 'Introduction to Mechanical Engineering I', 'G1'),
(2, 4, 'Kelly', 2, 'Electrical Engineering II', 'G1'),
(3, 4, 'Kelly', 5, 'Introduction to Mechanical Engineering II', 'G1');

COMMIT;

--
-- QUIZZES table
--
        -- q.course_id = cid;
        -- q.course_class_id = ccid;
        -- q.section_id = sid;
        -- q.quiz_id = qid;
        -- q.quiz_title = quizTitle;
        -- q.quiz_type = quizType;
        -- var question_number = qno[i];
        -- q.question_no = question_number;
        -- q.question = que[question_number];
        -- q.number_of_options = numOp[question_number];
        -- q.options_content = optionContent[question_number];
        -- var posAns = answerArray[question_number];
        -- q.correct_answer = optionContent[question_number][posAns];
DROP TABLE IF EXISTS `quizzes`;
CREATE TABLE IF NOT EXISTS `quizzes` (
    `course_id` int(64) NOT NULL ,
    `course_class_id` int(64) NOT NULL,
    `section_id` int(64) NOT NULL,
    `quiz_id` int(64) NOT NULL,
    `quiz_title` varchar(100) NOT NULL,
    `quiz_type` varchar(80) NOT NULL,
    `question_no` int(64) NOT NULL,
    `question` varchar(100) NOT NULL,
    `number_of_options` int(64) NOT NULL,
    `options_content` varchar(1000) NOT NULL,
    `correct_answer` varchar(100) NOT NULL
    -- FOREIGN KEY (section_id) REFERENCES sections(section_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

ALTER TABLE quizzes ADD CONSTRAINT PK_Quiz PRIMARY KEY (course_id,course_class_id,section_id,quiz_id,question_no);
--
-- Dumping data for table `quiz_answers`
--

INSERT INTO `quizzes` (`course_id`,`course_class_id`,`section_id`,`quiz_id`,`quiz_title`,`quiz_type`, `question_no`, `question`, `number_of_options`, `options_content` ,`correct_answer`) VALUES
(1, 1, 1, 1,'quiz title 1','graded',1,'Is it true that it is like this?', 2, 'true,false','true'),
(1, 1, 1, 1,'guiz title 2','ungraded',2,'Is it true that it is like this?', 2, 'true,false','false'),
(1, 1, 1, 1,'quiz title 3','graded',3,'Is it true that it is like this?', 2, 'true,false','false');
COMMIT;

--
-- SECTON_PROGRESS table
--

DROP TABLE IF EXISTS `section_progress`;
CREATE TABLE IF NOT EXISTS `section_progress` (
    `section_progress_id` int(64) NOT NULL AUTO_INCREMENT, 
    `user_id` int(64) NOT NULL,
    `user_name` varchar(64) NOT NULL,
    `course_id` int(64) NOT NULL,
    `course_name` varchar(64) NOT NULL,
    `class_name` varchar(64) NOT NULL,
    `section_id` int(64) NOT NULL,
    `section_completion_status` varchar(64) NOT NULL,
    `quiz_completion_status` varchar(64) NOT NULL,
    PRIMARY KEY (`section_progress_id`),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id),
    FOREIGN KEY (section_id) REFERENCES sections(section_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section_progress`
--

INSERT INTO `section_progress` (`section_progress_id`, `user_id`, `user_name`,`course_id`, `course_name`, `class_name`,`section_id`, `section_completion_status`, `quiz_completion_status`) VALUES
(1, 1, 'Jonathan', 2, 'Introduction to Mechanical Engineering', 'Alpha', 1, 'Completed', 'Completed'),
(2, 1, 'Jonathan', 2, 'Introduction to Mechanical Engineering', 'Alpha', 2, 'Not Completed', 'Not Completed'),
(3, 1, 'Jonathan', 2, 'Introduction to Mechanical Engineering', 'Alpha', 3, 'Not Completed', 'Not Completed');
COMMIT;

--
-- COURSE_TRAINERS table
--

-- DROP TABLE IF EXISTS `course_trainers`;
-- CREATE TABLE IF NOT EXISTS `course_trainers` (
--     `course_trainer_id` int(64) NOT NULL AUTO_INCREMENT,  
--     `course_id` int(64) NOT NULL,
--     `course_name` varchar(64) NOT NULL,
--     `user_id` int(64) NOT NULL,
--     `user_name` varchar(64) NOT NULL,
--     PRIMARY KEY (`course_trainer_id`),
--     FOREIGN KEY (user_id) REFERENCES users(user_id),
--     FOREIGN KEY (course_id) REFERENCES courses(course_id)
-- ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_trainers`
--

-- INSERT INTO `course_trainers` (`course_trainer_id`, `course_id`, `course_name`, `user_id`, `user_name`) VALUES
-- (1, 1, 'Electrical Engineering', 2, 'Roger'),
-- (2, 2, 'Introduction to Mechanical Engineering', 2, 'Roger'),
-- (3, 3, 'Introduction to Scrum Methodology', 2, 'Roger');
-- COMMIT;


--
-- QUIZ_PROGRESS table
--

-- DROP TABLE IF EXISTS `quiz_progress`;
-- CREATE TABLE IF NOT EXISTS `quiz_progress` (
--     `quiz_progress_id` int(64) NOT NULL AUTO_INCREMENT, 
--     `user_id` int(64) NOT NULL,
--     `course_id` int(64) NOT NULL,
--     `section_id` int(64) NOT NULL,
--     `completion_status` varchar(64) NOT NULL,
--     PRIMARY KEY (`quiz_progress_id`),
--     FOREIGN KEY (user_id) REFERENCES users(user_id),
--     FOREIGN KEY (course_id) REFERENCES courses(course_id),
--     FOREIGN KEY (section_id) REFERENCES sections(section_id)
-- ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quiz_progress`
--

-- INSERT INTO `quiz_progress` (`quiz_progress_id`, `user_id`, `course_id`, `section_id`, `completion_status`) VALUES
-- (1, 1, 2, 1, 'Completed'),
-- (2, 1, 2, 2, 'Not Completed'),
-- (3, 1, 2, 3, 'Not Completed');
-- COMMIT;

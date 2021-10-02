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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_role`, `login_id`, `login_password`) VALUES
(1, 'Jonathan','engineer', 'test@hotmail.com', '0000'),
(2, 'Roger','trainer', 'test@yahoo.com', '0000'),
(3, 'Betty','administrator', 'test@gmail.com', '0000'),
(4, 'Kelly','engineer', 'test2@gmail.com', '0000'),
(5, 'Aaron','trainer', 'test3@gmail.com', '0000');

COMMIT;

--
-- COURSES table
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
    `course_id` int(64) NOT NULL AUTO_INCREMENT,
    `course_name` varchar(64) NOT NULL,
    `course_desc` text NOT NULL,
    `class_name` varchar(64) NOT NULL,
    `start_date` DATETIME NOT NULL,
    `end_date` DATETIME NOT NULL,
    `slots_available` int(64) NOT NULL,
    `image` varchar(64),
    PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_desc`, `class_name`,`start_date`, `end_date`, `slots_available`, `image`) VALUES
(1, 'Electrical Engineering','course description', 'Alpha','2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 'image'),
(2, 'Introduction to Mechanical Engineering','course description', 'Alpha', '2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 'image'),
(3, 'Introduction to Scrum Methodology','course description', 'Beta','2021-01-01 00:00:00', '2021-02-01 00:00:00', 100, 'image');
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
(1, 1, 'Electrical Engineering', 'Alpha', 1, 'Introduction','url'),
(2, 1, 'Electrical Engineering', 'Beta', 1, 'Introduction','url'),
(3, 1, 'Electrical Engineering', 'Alpha', 2, 'The Second Chapter','url');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `completed_courses`
--

INSERT INTO `completed_courses` (`completed_course_id`, `user_id`, `user_name`,`course_id`, `course_name`) VALUES
(1, 1, 'Jonathan', 1, 'Electrical Engineering'),
(2, 1, 'Jonathan', 3, 'Introduction to Scrum Methodology'),
(3, 4, 'Kelly', 1, 'Electrical Engineering');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_prerequisites`
--

INSERT INTO `course_prerequisites` (`id`, `course_id`, `course_name`,`prerequisite_course_id`, `prerequisite_course_name`) VALUES
(1, 1, 'Electrical Engineering', 2, 'Introduction to Mechanical Engineering'),
(2, 1, 'Electrical Engineering', 3, 'Introduction to Scrum Methodology'),
(3, 2, 'Introduction to Mechanical Engineering', 1, 'Electrical Engineering');
COMMIT;

--
-- COURSE_TRAINERS table
--

DROP TABLE IF EXISTS `course_trainers`;
CREATE TABLE IF NOT EXISTS `course_trainers` (
    `course_trainer_id` int(64) NOT NULL AUTO_INCREMENT,  
    `course_id` int(64) NOT NULL,
    `course_name` varchar(64) NOT NULL,
    `user_id` int(64) NOT NULL,
    `user_name` varchar(64) NOT NULL,
    PRIMARY KEY (`course_trainer_id`),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_trainers`
--

INSERT INTO `course_trainers` (`course_trainer_id`, `course_id`, `course_name`, `user_id`, `user_name`) VALUES
(1, 1, 'Electrical Engineering', 2, 'Roger'),
(2, 2, 'Introduction to Mechanical Engineering', 2, 'Roger'),
(3, 3, 'Introduction to Scrum Methodology', 2, 'Roger');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainer_qualifications`
--

INSERT INTO `trainer_qualifications` (`trainer_qualification_id`, `user_id`, `user_name`,`course_id`, `course_name`) VALUES
(1, 2, 'Roger', 1, 'Electrical Engineering'),
(2, 2, 'Roger', 2, 'Introduction to Mechanical Engineering'),
(3, 2, 'Roger', 3, 'Introduction to Scrum Methodology');
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
    PRIMARY KEY (`enrolled_course_id`),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enrolled_courses`
--

INSERT INTO `enrolled_courses` (`enrolled_course_id`, `user_id`, `user_name`,`course_id`, `course_name`) VALUES
(1, 1, 'Jonathan', 1, 'Electrical Engineering'),
(2, 1, 'Jonathan', 2, 'Introduction to Mechanical Engineering'),
(3, 1, 'Jonathan', 3, 'Introduction to Scrum Methodology');
COMMIT;

--
-- QUIZZES table
--

DROP TABLE IF EXISTS `quizzes`;
CREATE TABLE IF NOT EXISTS `quizzes` (
    `quiz_id` int(64) NOT NULL AUTO_INCREMENT, 
    `section_id` int(64) NOT NULL,
    `question` int(64) NOT NULL,
    `question_type` varchar(64) NOT NULL,
    `number_of_options` int(64) NOT NULL,
    `correct_answer` varchar(64) NOT NULL,
    PRIMARY KEY (`quiz_id`),
    FOREIGN KEY (section_id) REFERENCES sections(section_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quiz_answers`
--

INSERT INTO `quizzes` (`quiz_id`, `section_id`, `question`, `question_type`, `number_of_options`, `correct_answer`) VALUES
(1, 1, 'Is it true that it is like this?', 'truefalse', 2, 'true'),
(2, 1, 'Is it true that it is like this?', 'truefalse', 2, 'false'),
(3, 1, 'Which option is correct?', 'mcq', 4, '4');
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

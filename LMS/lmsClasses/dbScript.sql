SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `LMS` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `LMS`;


DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
    `user_id` int(64) NOT NULL AUTO_INCREMENT,
    `user_name` varchar(64) NOT NULL,
    `user_role` varchar(64) NOT NULL,
    `login_id` varchar(64) NOT NULL,
    `login_password` varchar(64) NOT NULL,
    PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

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


DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
    `course_id` int(64) NOT NULL AUTO_INCREMENT,
    `course_name` varchar(64) NOT NULL,
    `course_desc` text NOT NULL,
    `class_name` varchar(64) NOT NULL,
    `start_date` DATETIME NOT NULL,
    `end_date` DATETIME NOT NULL,
    `slots_available` int(64) NOT NULL,
    PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_desc`, `class_name`,`start_date`, `end_date`, `slots_available`) VALUES
(1, 'Electrical Engineering','course description', 'Alpha','2021-01-01 00:00:00', '2021-02-01 00:00:00', 100),
(2, 'Introduction to Mechanical Engineering','course description', 'Alpha', '2021-01-01 00:00:00', '2021-02-01 00:00:00', 100),
(3, 'Introduction to Scrum Methodology','course description', 'Beta','2021-01-01 00:00:00', '2021-02-01 00:00:00', 100);
COMMIT;


DROP TABLE IF EXISTS `sections`;
CREATE TABLE IF NOT EXISTS `sections` (
    `section_id` int(64) NOT NULL AUTO_INCREMENT, 
    `course_id` int(64) NOT NULL,
    `course_section_number` int(64) NOT NULL,
    `section_name` varchar(64) NOT NULL,
    `course_material_link` varchar(64) NOT NULL,
    PRIMARY KEY (`section_id`),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`section_id`, `course_id`, `course_section_number`, `section_name`, `course_material_link`) VALUES
(1, 3, 1, 'Introduction', 'url'),
(2, 3, 2, 'Benefits', 'url'),
(3, 3, 3, 'Scrum Board', 'url');
COMMIT;


DROP TABLE IF EXISTS `completed_courses`;
CREATE TABLE IF NOT EXISTS `completed_courses` (
    `completed_course_id` int(64) NOT NULL AUTO_INCREMENT,
    `user_id` int(64) NOT NULL,
    `course_id` int(64) NOT NULL,
    PRIMARY KEY (`completed_course_id`),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `completed_courses`
--

INSERT INTO `completed_courses` (`completed_course_id`, `user_id`, `course_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 1);
COMMIT;


DROP TABLE IF EXISTS `course_prerequisites`;
CREATE TABLE IF NOT EXISTS `course_prerequisites` (
    `id` int(64) NOT NULL AUTO_INCREMENT,
    `course_id` int(64) NOT NULL,
    `prerequisite_course_id` int(64) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_prerequisites`
--

INSERT INTO `course_prerequisites` (`id`, `course_id`, `prerequisite_course_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 1);
COMMIT;


DROP TABLE IF EXISTS `course_trainers`;
CREATE TABLE IF NOT EXISTS `course_trainers` (
    `course_trainer_id` int(64) NOT NULL AUTO_INCREMENT, 
    `user_id` int(64) NOT NULL,
    `course_id` int(64) NOT NULL,
    PRIMARY KEY (`course_trainer_id`),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_trainers`
--

INSERT INTO `course_trainers` (`course_trainer_id`, `course_id`, `user_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2);
COMMIT;


DROP TABLE IF EXISTS `trainer_qualifications`;
CREATE TABLE IF NOT EXISTS `trainer_qualifications` (
    `trainer_qualification_id` int(64) NOT NULL AUTO_INCREMENT, 
    `user_id` int(64) NOT NULL,
    `course_id` int(64) NOT NULL,
    PRIMARY KEY (`trainer_qualification_id`),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainer_qualifications`
--

INSERT INTO `trainer_qualifications` (`trainer_qualification_id`, `course_id`, `user_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3);
COMMIT;


DROP TABLE IF EXISTS `enrolled_courses`;
CREATE TABLE IF NOT EXISTS `enrolled_courses` (
    `enrolled_course_id` int(64) NOT NULL AUTO_INCREMENT,
    `user_id` int(64) NOT NULL,
    `course_id` int(64) NOT NULL,
    PRIMARY KEY (`enrolled_course_id`),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enrolled_courses`
--

INSERT INTO `enrolled_courses` (`enrolled_course_id`, `user_id`, `course_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 1);
COMMIT;


DROP TABLE IF EXISTS `quiz_answers`;
CREATE TABLE IF NOT EXISTS `quiz_answers` (
    `quiz_answer_id` int(64) NOT NULL AUTO_INCREMENT, 
    `section_id` int(64) NOT NULL,
    `answer` varchar(64) NOT NULL,
    PRIMARY KEY (`quiz_answer_id`),
    FOREIGN KEY (section_id) REFERENCES sections(section_id)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quiz_answers`
--

INSERT INTO `quiz_answers` (`quiz_answer_id`, `section_id`, `answer`) VALUES
(1, 1, 'true'),
(2, 1, 'false'),
(3, 1, '4');
COMMIT;
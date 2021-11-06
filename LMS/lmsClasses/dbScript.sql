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
    `course_desc` varchar(1000) NOT NULL,
    `image` varchar(64),
    PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_desc`, `image`) VALUES
(1, 'Electrical Engineering I','Electrical engineering deals with the study and application of physics and mathematics combined with elements of electricity, electronics, and electromagnetism to both large and small scale systems to process information and transmit energy.', 'assets/Electrical1.jpg'),
(2, 'Electrical Engineering II','Electrical engineering deals with the study and application of physics and mathematics combined with elements of electricity, electronics, and electromagnetism to both large and small scale systems to process information and transmit energy.', 'assets/Electrical2.jpg'),
(3, 'Electrical Engineering III','Electrical engineering deals with the study and application of physics and mathematics combined with elements of electricity, electronics, and electromagnetism to both large and small scale systems to process information and transmit energy.', 'assets/Electrical3.jpg'),
(4, 'Introduction to Mechanical Engineering I','Mechanical engineering is an engineering branch that combines engineering physics and mathematics principles with materials science to design, analyze, manufacture, and maintain mechanical systems.', 'assets/MechanicalEngineering1.jpg'),
(5, 'Introduction to Mechanical Engineering II','Mechanical engineering is an engineering branch that combines engineering physics and mathematics principles with materials science to design, analyze, manufacture, and maintain mechanical systems.', 'assets/MechanicalEngineering2.jpg'),
(6, 'Introduction to Mechanical Engineering III','Mechanical engineering is an engineering branch that combines engineering physics and mathematics principles with materials science to design, analyze, manufacture, and maintain mechanical systems.', 'assets/MechanicalEngineering3.jpg'),
(7, 'Introduction to Scrum Methodology I','Scrum is a framework for developing, delivering, and sustaining products in a complex environment, with an initial emphasis on software development, although it has been used in other fields including research, sales, marketing and advanced technologies.', 'assets/Scrum1.jpg'),
(8, 'Introduction to Scrum Methodology II','Scrum is a framework for developing, delivering, and sustaining products in a complex environment, with an initial emphasis on software development, although it has been used in other fields including research, sales, marketing and advanced technologies.', 'assets/Scrum2.jpg'),
(9, 'Introduction to Scrum Methodology III','Scrum is a framework for developing, delivering, and sustaining products in a complex environment, with an initial emphasis on software development, although it has been used in other fields including research, sales, marketing and advanced technologies.', 'assets/Scrum3.jpg');

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
(3, 1, 'Electrical Engineering', 'G1', 2, 'The Second Chapter','url'),
(4, 4, 'Introduction to Mechanical Engineering I', 'G1', 1, 'Introduction','url'),
(5, 4, 'Introduction to Mechanical Engineering I', 'G2', 1, 'Introduction','url'),
(6, 4, 'Introduction to Mechanical Engineering I', 'G1', 2, 'The Second Chapter','url'),
(7, 3, 'Electrical Engineering III', 'G1', 1, 'Introduction','url'),
(8, 3, 'Electrical Engineering III', 'G2', 1, 'Introduction','url'),
(9, 3, 'Electrical Engineering III', 'G1', 2, 'The Second Chapter','url');
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
    `image` varchar(64) NOT NULL,
    PRIMARY KEY (`completed_course_id`),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `completed_courses`
--

INSERT INTO `completed_courses` (`completed_course_id`, `user_id`, `user_name`,`course_id`, `course_name`, `image`) VALUES
(1, 1, 'Jonathan', 1, 'Electrical Engineering I', 'Electrical1.jpg'),
(2, 1, 'Jonathan', 2, 'Electrical Engineering II', 'Electrical2.jpg'),
(3, 1, 'Jonathan', 7, 'Introduction to Scrum Methodology I', 'Scrum1.jpg'),
(4, 4, 'Kelly', 1, 'Electrical Engineering I', 'Electrical1.jpg'),
(5, 4, 'Kelly', 4, 'Introduction to Mechanical Engineering I', 'MechanicalEngineering1.jpg'),
(6, 4, 'Kelly', 7, 'Introduction to Scrum Methodology I', 'Scrum1.jpg');

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
    `image` varchar(64) NOT NULL,
    PRIMARY KEY (`required_course_id`),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (course_id) REFERENCES courses(course_id)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `required_courses`
--

INSERT INTO `required_courses` (`required_course_id`, `user_id`, `user_name`,`course_id`, `course_name`, `image`) VALUES
(1, 1, 'Jonathan', 3, 'Electrical Engineering III', 'Electrical3.jpg'),
(2, 1, 'Jonathan', 5, 'Introduction to Mechanical Engineering II', 'MechanicalEngineering2.jpg'),
(3, 1, 'Jonathan', 6, 'Introduction to Mechanical Engineering III', 'MechanicalEngineering3.jpg'),
(4, 1, 'Jonathan', 8, 'Introduction to Scrum Methodology II', 'Scrum2.jpg'),
(5, 1, 'Jonathan', 9, 'Introduction to Scrum Methodology III', 'Scrum3.jpg'),
(6, 4, 'Kelly', 3, 'Electrical Engineering III', 'Electrial3.jpg'),
(7, 4, 'Kelly', 6, 'Introduction to Mechanical Engineering III', 'MechanicalEngineering3.jpg'),
(8, 4, 'Kelly', 8, 'Introduction to Scrum Methodology II', 'Scrum2.jpg'),
(9, 4, 'Kelly', 9, 'Introduction to Scrum Methodology III', 'Scrum3.jpg');

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



-- QUIZ_PROGRESS table


DROP TABLE IF EXISTS `quiz_progress`;
CREATE TABLE IF NOT EXISTS `quiz_progress` (
    `user_id` int(64) NOT NULL,
    `course_id` int(64) NOT NULL,
    `course_class_id` int(64) NOT NULL,
    `section_id` int(64) NOT NULL,
    `completion_status` varchar(64) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id)

) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

ALTER TABLE quiz_progress ADD CONSTRAINT PK_Quiz PRIMARY KEY (user_id,course_id,course_class_id,section_id);

-- Dumping data for table `quiz_progress`


INSERT INTO `quiz_progress` ( `user_id`, `course_id`, `course_class_id`, `section_id`, `completion_status`) VALUES
(1, 1, 1, 1, 'Completed'),
(1, 1, 2, 2, 'Completed'),
(1, 1, 2, 3, 'Completed'),
(1, 4, 1, 1, 'Not Completed'),
(1, 4, 1, 2, 'Not Completed'),
(1, 4, 2, 3, 'Not Completed');
COMMIT;

DROP TABLE IF EXISTS `materials`;
CREATE TABLE IF NOT EXISTS `materials` (
    `course_id` int(64) NOT NULL ,
    `course_class_id` int(64) NOT NULL,
    `section_id` int(64) NOT NULL,
    `material_id` int(64) NOT NULL,
    `material_name` varchar(100) NOT NULL,
    `material_url` varchar(80) NOT NULL,
    `completion_status` varchar(80) NOT NULL
    -- FOREIGN KEY (section_id) REFERENCES sections(section_id)
);

ALTER TABLE materials ADD CONSTRAINT PK_Material PRIMARY KEY (course_id,course_class_id,section_id,material_id);

INSERT INTO `materials` (course_id, course_class_id, section_id, material_id, material_name, material_url, completion_status) values (8, 1, 1, 1, 'What is Scrum?', 'https://www.youtube.com/watch?v=oTZd2vo3FQU', 'Not Completed');
INSERT INTO `materials` (course_id, course_class_id, section_id, material_id, material_name, material_url, completion_status) values (8, 1, 2, 1, 'Scrum in under 5 Minutes', 'https://www.youtube.com/watch?v=2Vt7Ik8Ublw', 'Not Completed');
INSERT INTO `materials` (course_id, course_class_id, section_id, material_id, material_name, material_url, completion_status) values (8, 1, 3, 1, 'Scrum Methodology', 'https://www.youtube.com/watch?v=8dGdIcyDk1w', 'Not Completed');
INSERT INTO `materials` (course_id, course_class_id, section_id, material_id, material_name, material_url, completion_status) values (4, 1, 1, 1, 'What is Mechanical Engineering?', 'https://www.youtube.com/watch?v=W74y1RxN6BA', 'Not Completed');
INSERT INTO `materials` (course_id, course_class_id, section_id, material_id, material_name, material_url, completion_status) values (4, 1, 2, 1, 'Fundamentals of Mechanical Engineering','https://www.youtube.com/watch?v=ehi_hkLlutw','Not Completed');
INSERT INTO `materials` (course_id, course_class_id, section_id, material_id, material_name, material_url, completion_status) values (4, 1, 3, 1, 'How to be a Mechanical Engineer in Nepal?', 'https://www.youtube.com/watch?v=t0W_Qq2-hkM', 'Not Completed');
INSERT INTO `materials` (course_id, course_class_id, section_id, material_id, material_name, material_url, completion_status) values (1, 1, 1, 1, 'What is Electrical Engineering?', 'https://www.youtube.com/watch?v=QQewdCJTcIU', 'Completed');
INSERT INTO `materials` (course_id, course_class_id, section_id, material_id, material_name, material_url, completion_status) values (1, 1, 2, 1, 'How ELECTRICITY works - working principle','https://www.youtube.com/watch?v=mc979OhitAg','Completed');
INSERT INTO `materials` (course_id, course_class_id, section_id, material_id, material_name, material_url, completion_status) values (1, 1, 3, 1, 'How does a Transformer work - Working Principle electrical engineering', 'https://www.youtube.com/watch?v=UchitHGF4n8', 'Completed');

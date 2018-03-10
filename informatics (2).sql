-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2018 at 08:41 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `informatics`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `c_schedule_id_fk` int(11) NOT NULL,
  `chat_teach_id` int(11) NOT NULL,
  `chat_message` varchar(255) NOT NULL,
  `chat_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `chat_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `c_schedule_id_fk`, `chat_teach_id`, `chat_message`, `chat_time`, `chat_status`) VALUES
(10, 87, 0, 'please change this!!', '2018-01-20 02:30:59', 'Done');

-- --------------------------------------------------------

--
-- Table structure for table `day`
--

CREATE TABLE `day` (
  `day_id` int(11) NOT NULL,
  `day_name` varchar(20) NOT NULL,
  `day_code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `day`
--

INSERT INTO `day` (`day_id`, `day_name`, `day_code`) VALUES
(0, 'No Rest Day', 'NRD'),
(1, 'Monday', 'M'),
(2, 'Tuesday', 'T'),
(3, 'Wednesday', 'W'),
(4, 'Thursday', 'TH'),
(5, 'Friday', 'F'),
(6, 'Saturday', 'S');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_schoolyear` varchar(40) NOT NULL,
  `exam_term` varchar(20) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `exam_schedule_id_fk` int(11) NOT NULL,
  `exam_day` int(11) NOT NULL,
  `exam_teacher` int(11) NOT NULL,
  `exam_room` int(11) NOT NULL,
  `exam_class` varchar(20) NOT NULL,
  `exam_subject_id_fk` int(11) NOT NULL,
  `exam_section_id_fk` int(11) NOT NULL,
  `exam_start_time` varchar(100) NOT NULL,
  `exam_end_time` varchar(100) NOT NULL,
  `exam_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_schoolyear`, `exam_term`, `exam_id`, `exam_schedule_id_fk`, `exam_day`, `exam_teacher`, `exam_room`, `exam_class`, `exam_subject_id_fk`, `exam_section_id_fk`, `exam_start_time`, `exam_end_time`, `exam_date`) VALUES
('', '1st Term', 22, 86, 1, 13, 4, 'Prelim', 0, 0, '07:01:00', '09:59:00', '2018-01-20 02:23:06');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL,
  `log_user` varchar(50) NOT NULL,
  `log_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `log_entry` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`log_id`, `log_user`, `log_time`, `log_entry`) VALUES
(408, 'deegabriel', '2018-01-20 01:06:16', 'Logged In'),
(409, 'deegabriel', '2018-01-20 01:07:12', 'Logged Out'),
(410, 'zenoseo', '2018-01-20 01:08:08', 'Logged In'),
(411, 'zenoseo', '2018-01-20 01:10:51', 'Logged Out'),
(412, 'janerika', '2018-01-20 01:11:03', 'Logged In'),
(413, 'dedsinon', '2018-01-20 01:41:46', 'Logged Out'),
(414, 'dedsinon', '2018-01-20 01:41:52', 'Logged In'),
(415, 'janerika', '2018-01-20 01:43:02', 'Logged In'),
(416, 'janerika', '2018-01-20 01:43:16', 'Logged Out'),
(417, 'dedsinon', '2018-01-20 01:45:10', 'Logged In'),
(418, 'janerika', '2018-01-20 01:45:48', 'Logged In'),
(419, 'janerika', '2018-01-20 01:46:03', 'Logged Out'),
(420, 'dedsinon', '2018-01-20 01:52:09', 'Logged In'),
(421, 'dedsinon', '2018-01-20 02:06:30', 'Logged Out'),
(422, 'janerika', '2018-01-20 02:06:56', 'Logged In'),
(423, 'rmacarang', '2018-01-20 02:07:40', 'Logged In'),
(424, 'janerika', '2018-01-20 02:07:55', 'Logged In'),
(425, 'deegabriel', '2018-01-20 02:26:58', 'Logged In'),
(426, 'deegabriel', '2018-01-20 02:27:59', 'Logged In'),
(427, 'deegabriel', '2018-01-20 02:28:25', 'Logged In'),
(428, 'janerika', '2018-01-20 02:33:53', 'Logged Out'),
(429, 'rmacarang', '2018-01-20 02:35:08', 'Logged Out'),
(430, 'janerika', '2018-01-20 02:37:00', 'Logged In'),
(431, 'rmacarang', '2018-01-20 02:56:10', 'Logged In'),
(432, 'deegabriel', '2018-01-20 03:08:45', 'Logged In'),
(433, 'dedsinon', '2018-01-20 03:09:05', 'Logged In'),
(434, 'dedsinon', '2018-02-08 15:51:14', 'Logged In'),
(435, 'dedsinon', '2018-02-20 02:55:56', 'Logged In'),
(436, 'dedsinon', '2018-03-08 15:29:24', 'Logged In'),
(437, 'dedsinon', '2018-03-09 05:51:41', 'Logged In');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring`
--

CREATE TABLE `monitoring` (
  `m_id` int(11) NOT NULL,
  `m_schedule_id_fk` int(11) NOT NULL,
  `m_subject_id_fk` int(11) NOT NULL,
  `m_teacher_id_fk` int(11) NOT NULL,
  `m_room_id_fk` int(11) NOT NULL,
  `m_sc_id_fk` int(11) NOT NULL,
  `m_section_id_fk` int(11) NOT NULL,
  `m_day_id_fk` int(11) NOT NULL,
  `m_school_year_fk` varchar(20) NOT NULL,
  `m_term_grading_fk` varchar(30) NOT NULL,
  `m_username` varchar(50) NOT NULL,
  `m_remarks` varchar(20) NOT NULL,
  `m_comments` varchar(255) NOT NULL,
  `m_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `m_is_monitored` int(11) NOT NULL,
  `m_view` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monitoring`
--

INSERT INTO `monitoring` (`m_id`, `m_schedule_id_fk`, `m_subject_id_fk`, `m_teacher_id_fk`, `m_room_id_fk`, `m_sc_id_fk`, `m_section_id_fk`, `m_day_id_fk`, `m_school_year_fk`, `m_term_grading_fk`, `m_username`, `m_remarks`, `m_comments`, `m_date`, `m_is_monitored`, `m_view`) VALUES
(1, 86, 70, 13, 4, 1, 7, 1, '2019-2020', '1st Term', 'janerika', '1', '', '2018-01-20 02:32:39', 1, 0),
(2, 87, 76, 14, 5, 4, 11, 1, '2019-2020', '1st Quarter', 'janerika', '3', 'late', '2018-01-20 02:37:41', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `monitor_legend`
--

CREATE TABLE `monitor_legend` (
  `legend_id` int(11) NOT NULL,
  `legend_code` varchar(5) NOT NULL,
  `legend_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monitor_legend`
--

INSERT INTO `monitor_legend` (`legend_id`, `legend_code`, `legend_name`) VALUES
(1, 'P', 'Present'),
(2, 'A', 'Absent'),
(3, 'L', 'Late'),
(4, 'OL', 'On Leave'),
(5, 'NC', 'No Class');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notif_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_notify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_read` tinyint(4) NOT NULL,
  `date_read` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `room_name` varchar(70) NOT NULL,
  `room_classification` int(11) NOT NULL,
  `room_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_number`, `room_name`, `room_classification`, `room_status`) VALUES
(4, '201', 'Charles Babbage', 2, 'Activated'),
(5, '301', 'Augusta Byron', 1, 'Activated'),
(6, '302', 'Dennis Ritchie', 1, 'Activated'),
(7, '303', 'James Gosling', 1, 'Activated'),
(8, '304', 'Daryl Sinon', 2, 'Activated'),
(9, '400', 'Bill Gates - ICL', 1, 'Activated'),
(10, '401', 'Steve Jobs', 1, 'Activated'),
(11, '402', 'Larry Page', 1, 'Activated'),
(12, '403', 'Mark Zuckerburg', 1, 'Activated'),
(13, '404', 'Tim Bernes Lee', 1, 'Activated'),
(14, '202', 'Library', 1, 'Activated');

-- --------------------------------------------------------

--
-- Table structure for table `room_class`
--

CREATE TABLE `room_class` (
  `room_class_id` int(11) NOT NULL,
  `room_class` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_class`
--

INSERT INTO `room_class` (`room_class_id`, `room_class`) VALUES
(1, 'Lecture Room'),
(2, 'Computer Laboratory Room');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `subject_id_fk` int(11) NOT NULL,
  `teacher_id_fk` int(11) NOT NULL,
  `room_id_fk` int(11) NOT NULL,
  `sc_id_fk` int(11) NOT NULL,
  `school_year` varchar(20) NOT NULL,
  `course_strand` varchar(20) NOT NULL,
  `term_grading` varchar(40) NOT NULL,
  `section_id_fk` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `start_time` varchar(40) NOT NULL,
  `end_time` varchar(40) NOT NULL,
  `background_color` varchar(10) NOT NULL,
  `border_color` varchar(10) NOT NULL,
  `text_color` varchar(10) NOT NULL,
  `is_approved` varchar(5) NOT NULL,
  `schedule_type` varchar(10) NOT NULL,
  `schedule_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_monitored` int(11) NOT NULL,
  `comments` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `subject_id_fk`, `teacher_id_fk`, `room_id_fk`, `sc_id_fk`, `school_year`, `course_strand`, `term_grading`, `section_id_fk`, `day`, `start_time`, `end_time`, `background_color`, `border_color`, `text_color`, `is_approved`, `schedule_type`, `schedule_created`, `is_monitored`, `comments`) VALUES
(86, 70, 13, 4, 1, '2019-2020', 'Course', '1st Term', 7, '1', '08:01:00', '09:59:00', '#5bc0de', '#46b8da', '#000000', 'no', '', '2018-01-20 02:13:28', 0, ''),
(87, 76, 14, 5, 4, '2019-2020', 'Strand', '1st Quarter', 11, '1', '09:01:00', '11:59:00', '#5bc0de', '#46b8da', '#000000', 'no', '', '2018-01-20 02:16:35', 0, ''),
(88, 70, 13, 4, 1, '2019-2020', 'Course', '1st Term', 7, '', '08:01:00', '08:59:00', '#5bc0de', '#46b8da', '#000000', 'no', '', '2018-03-08 15:52:00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_icl`
--

CREATE TABLE `schedule_icl` (
  `icl_id` int(11) NOT NULL,
  `icl_teacher_id_fk` int(11) NOT NULL,
  `icl_room_id_fk` int(11) NOT NULL,
  `icl_school_year` varchar(20) NOT NULL,
  `icl_course_name` varchar(100) NOT NULL,
  `icl_day` varchar(10) NOT NULL,
  `icl_start_time` varchar(40) NOT NULL,
  `icl_end_time` varchar(40) NOT NULL,
  `icl_schedule_type` varchar(10) NOT NULL,
  `icl_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule_icl`
--

INSERT INTO `schedule_icl` (`icl_id`, `icl_teacher_id_fk`, `icl_room_id_fk`, `icl_school_year`, `icl_course_name`, `icl_day`, `icl_start_time`, `icl_end_time`, `icl_schedule_type`, `icl_date_created`) VALUES
(2, 13, 4, '2017-2018', 'asdasd', '1', '09:01:00', '10:59:00', '', '2017-12-15 05:33:09'),
(3, 13, 4, '2017-2018', 'Basic Excel', '1,2,3', '13:01:00', '16:59:00', '', '2017-12-15 10:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `school_year_id` int(11) NOT NULL,
  `school_year` varchar(40) NOT NULL,
  `school_year_term` int(11) NOT NULL,
  `is_current` tinyint(4) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`school_year_id`, `school_year`, `school_year_term`, `is_current`, `status`) VALUES
(5, '2017-2018', 0, 0, 'Deactivate'),
(6, '2018-2019', 0, 0, 'Deactivate'),
(7, '2019-2020', 0, 1, 'Activated'),
(8, '2020-2021', 0, 0, 'Deactivate');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `sec_id` int(11) NOT NULL,
  `sc_id_fk` int(11) NOT NULL,
  `sec_code` varchar(50) NOT NULL,
  `sec_name` varchar(100) NOT NULL,
  `sec_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sec_id`, `sc_id_fk`, `sec_code`, `sec_name`, `sec_status`) VALUES
(7, 1, 'BSIT 1-1', 'Bachelor of Science in Information Technology 1-1', 'Activated'),
(8, 2, 'BSBA 1-1', 'Bachelor of Science in Business Administration 1-1', 'Activated'),
(9, 5, 'ICT 1-1', 'Information and Communication Technology Unix', 'Activated'),
(10, 3, 'ABM - Steve Jobs', 'Accountancy, Business and Management Steve Jobs', 'Activated'),
(11, 4, 'HUMSS - Sigmund Freud', 'Humanities and Social Sciences Sigmund Freud', 'Activated'),
(12, 1, 'BSIT NC 1-1', 'Bachelor of Science in Information Technology Night Class 1-1', 'Activated'),
(13, 2, 'BSBA NC 1-1', 'Bachelor of Science in Business Administration Night Class 1-1', 'Activated'),
(14, 1, 'BSIT 1-2', 'Bachelor of Science in Information Technology 1-2', 'Activated'),
(15, 5, 'ICT 1-2', 'Information and Communication Technology VISTA', 'Activated'),
(16, 2, 'BSBA 3-1', 'Bachelor of Science in Business Administration 3-1', 'Activated'),
(17, 1, 'IT/BA NC3-1', 'IT/BA NC3-1', 'Activated'),
(18, 1, 'BSIT 2-1', 'Bachelor of Science in Information Technology 2-1', 'Activated'),
(19, 1, 'BSIT 3-1', 'Bachelor of Science in Information Technology 3-1', 'Activated'),
(20, 5, 'ICT 2-1', 'Information and Communication Technology Mark Zuckerberg', 'Activated'),
(21, 5, 'ICT 2-2', 'Information and Communication Technology Bill Gates', 'Activated');

-- --------------------------------------------------------

--
-- Table structure for table `strand_course`
--

CREATE TABLE `strand_course` (
  `sc_id` int(11) NOT NULL,
  `sc_code` varchar(50) NOT NULL,
  `sc_name` varchar(100) NOT NULL,
  `sc_sc` varchar(50) NOT NULL,
  `sc_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `strand_course`
--

INSERT INTO `strand_course` (`sc_id`, `sc_code`, `sc_name`, `sc_sc`, `sc_status`) VALUES
(1, 'BSIT', 'Bachelor of Science in Information Technology', 'Course', 'Activated'),
(2, 'BSBA', 'Bachelor of Science in Business Administration', 'Course', 'Activated'),
(3, 'ABM', 'Accountancy, Business and Management', 'Strand', 'Activated'),
(4, 'HUMMS', 'Humanities and Social Sciences', 'Strand', 'Activated'),
(5, 'ICT', 'Information and Communication Technology', 'Strand', 'Activated'),
(8, 'GAS', 'General Academic Strand', 'Strand', 'Activated'),
(10, 'BSIS', 'Information System', 'Course', 'Activated');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subj_id` int(10) NOT NULL,
  `subj_code` varchar(10) NOT NULL,
  `subj_name` varchar(50) NOT NULL,
  `subj_unit` int(10) NOT NULL,
  `subj_term` varchar(20) NOT NULL,
  `subj_status` varchar(10) NOT NULL,
  `room_classification` varchar(50) NOT NULL,
  `sc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subj_id`, `subj_code`, `subj_name`, `subj_unit`, `subj_term`, `subj_status`, `room_classification`, `sc_id`) VALUES
(56, 'PD 1', 'Project Development', 0, '2nd Grading', 'Activated', 'Lecture Room', 5),
(57, 'IPM', 'Intro to Project Management', 0, '2nd Grading', 'Activated', 'Lecture Room', 5),
(58, 'TS', 'Track Specialization', 0, '2nd Grading', 'Activated', 'Lecture Room', 5),
(59, 'RWSD', 'Real World Software Development', 0, '2nd Grading', 'Activated', 'Lecture Room', 5),
(60, 'MIL', 'Media and Information Literacy', 0, '2nd Grading', 'Activated', 'Computer Laboratory Room', 3),
(61, 'PRG 4', 'Programming 4', 0, '2nd Grading', 'Activated', 'Computer Laboratory Room', 5),
(62, 'SAD', 'System Analysis and Design', 3, '3rd Term', 'Activated', 'Computer Laboratory Room', 1),
(63, 'SAD LAB', 'System Analysis and Design - LAB', 1, '3rd Term', 'Activated', 'Computer Laboratory Room', 1),
(64, 'OJT ', 'On The Job Training', 6, '3rd Term', 'Activated', 'Computer Laboratory Room', 1),
(65, 'OJT ', 'On The Job Training', 6, '3rd Term', 'Activated', 'Lecture Room', 2),
(66, 'DBMS NC LE', 'Database Management System NC LECTURE', 3, '3rd Term', 'Activated', 'Lecture Room', 1),
(68, 'OJT NC', 'OJT NC', 6, '3rd Term', 'Activated', 'Lecture Room', 1),
(69, 'OJT NC', 'OJT NC', 6, '3rd Term', 'Activated', 'Lecture Room', 2),
(70, 'IT 001', 'Web Development', 3, '1st Term', 'Activated', 'Computer Laboratory Room', 1),
(71, 'BA 001', 'Strategic Marketing', 3, '1st Term', 'Activated', 'Lecture Room', 2),
(72, 'GE 002', 'Philosophy and Logic', 2, '2nd Term', 'Activated', 'Lecture Room', 1),
(73, 'ENG 112', 'Communication Arts and Skills 2', 0, '2nd Term', 'Activated', 'Lecture Room', 1),
(74, 'ENG 112', 'Communication Arts and Skills 2', 3, '2nd Term', 'Activated', 'Lecture Room', 2),
(75, 'PD 1', 'Personal Development', 0, '1st Grading', 'Activated', 'Lecture Room', 3),
(76, 'TS1', 'Track Specialization 1', 0, '1st Grading', 'Activated', 'Lecture Room', 4),
(77, 'SC 111', 'Science 1', 0, '1st Grading', 'Activated', 'Lecture Room', 8);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(10) NOT NULL,
  `teacher_fullname` varchar(50) NOT NULL,
  `teacher_gender` varchar(50) NOT NULL,
  `teacher_contact` varchar(13) NOT NULL,
  `teacher_workstatus` varchar(50) NOT NULL,
  `teacher_subjmaj` varchar(100) NOT NULL,
  `teacher_profession` varchar(50) NOT NULL,
  `teacher_restday` int(11) NOT NULL,
  `teacher_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `teacher_fullname`, `teacher_gender`, `teacher_contact`, `teacher_workstatus`, `teacher_subjmaj`, `teacher_profession`, `teacher_restday`, `teacher_status`) VALUES
(13, 'Rolan M. Macarang', 'Male', '09123456789', 'Full Time', 'Information Technology', 'Master of Science in Information System', 1, 'Activated'),
(14, 'John Micko T. Nozaleda', 'Male', '4884532', 'Full Time', 'General Education', 'Master of Science in Psychology', 1, 'Activated'),
(15, 'Rachel Marie E. Salongcong', 'Female', '09174561236', 'Full Time', 'General Education', 'Master of Arts in English', 3, 'Activated'),
(16, 'Anilyn Joy Miranda', 'Female', '7857879', 'Full Time', 'Business Administration', 'Master of Science in Business Administration', 4, 'Activated'),
(17, 'Mary Rose Quinto', 'Female', '09124555555', 'Full Time', 'Information Technology', 'MSIT', 6, 'Activated'),
(18, 'John Ronald Ricafrente', 'Male', '0950565566656', 'Part Time', 'Information Technology', 'MSIT', 0, 'Activated');

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `term_id` int(11) NOT NULL,
  `term_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `user_id` int(10) NOT NULL,
  `user_fname` varchar(50) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_department` varchar(50) NOT NULL,
  `user_position` varchar(50) NOT NULL,
  `user_gender` varchar(6) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_privileges` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_pass` varchar(150) NOT NULL,
  `user_status` varchar(11) NOT NULL,
  `user_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_log` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`user_id`, `user_fname`, `user_lname`, `user_department`, `user_position`, `user_gender`, `user_email`, `user_privileges`, `user_name`, `user_pass`, `user_status`, `user_created`, `user_log`) VALUES
(1, 'Dianne Abigaile', 'Gabriel', 'Faculty', 'Center Manager', 'Female', 'dgabriel@yahoo.com', 'External', 'deegabriel', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Activated', '2017-12-08 08:11:45', '0000-00-00 00:00:00'),
(2, 'Daryl Elvin', 'Sinon', 'Marketing', 'Center Manager', 'Male', 'ded.sinon@yahoo.com', 'Admin', 'dedsinon', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Activated', '2017-10-31 18:07:37', '0000-00-00 00:00:00'),
(3, 'Jan Erika', 'Gonzales', 'Student Assistant', 'Student Assistant', 'Female', 'janerika@gonzales.com', 'Monitoring', 'janerika', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Activated', '2017-12-08 06:13:56', '0000-00-00 00:00:00'),
(4, 'Zenobia', 'Oseo', 'Services', 'Services Head', 'Female', 'zoseo@gmail.com', 'Reporting', 'zenoseo', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Activated', '2017-12-08 03:51:29', '0000-00-00 00:00:00'),
(8, 'Rolan ', 'Macarang', 'Administrative Department', 'Head Officer', 'Male', 'rmacarang@informatics.edu.ph', 'Admin', 'rmacarang', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Activated', '2017-12-08 03:54:21', '0000-00-00 00:00:00'),
(10, 'Jose', 'Rizal', 'Faculty Department', 'Head Officer', 'Male', 'jrizal@gmail.com', 'External', 'jprizal', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Activated', '2018-01-20 01:07:40', '0000-00-00 00:00:00'),
(11, 'Daryl', 'Sinon', 'Faculty Department', 'Student Assistant', 'Male', 'darylsinon@informatics.edu.ph', 'Monitoring', 'dsinon', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Deactivated', '2018-01-20 02:10:11', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `day`
--
ALTER TABLE `day`
  ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `monitoring`
--
ALTER TABLE `monitoring`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `monitor_legend`
--
ALTER TABLE `monitor_legend`
  ADD PRIMARY KEY (`legend_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `room_class`
--
ALTER TABLE `room_class`
  ADD PRIMARY KEY (`room_class_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `schedule_teacher_id` (`teacher_id_fk`),
  ADD KEY `subject_id_fk` (`subject_id_fk`),
  ADD KEY `room_id_fk` (`room_id_fk`,`sc_id_fk`,`section_id_fk`),
  ADD KEY `section_fk` (`section_id_fk`);

--
-- Indexes for table `schedule_icl`
--
ALTER TABLE `schedule_icl`
  ADD PRIMARY KEY (`icl_id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`school_year_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`sec_id`);

--
-- Indexes for table `strand_course`
--
ALTER TABLE `strand_course`
  ADD PRIMARY KEY (`sc_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subj_id`),
  ADD KEY `subj_id` (`subj_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`term_id`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `day`
--
ALTER TABLE `day`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=438;

--
-- AUTO_INCREMENT for table `monitoring`
--
ALTER TABLE `monitoring`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `monitor_legend`
--
ALTER TABLE `monitor_legend`
  MODIFY `legend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `room_class`
--
ALTER TABLE `room_class`
  MODIFY `room_class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `schedule_icl`
--
ALTER TABLE `schedule_icl`
  MODIFY `icl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `school_year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `sec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `strand_course`
--
ALTER TABLE `strand_course`
  MODIFY `sc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subj_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `term_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`subject_id_fk`) REFERENCES `subject` (`subj_id`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`room_id_fk`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `schedule_teacher_id` FOREIGN KEY (`teacher_id_fk`) REFERENCES `teacher` (`teacher_id`),
  ADD CONSTRAINT `section_fk` FOREIGN KEY (`section_id_fk`) REFERENCES `section` (`sec_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--SQL Page

--PhpMyAdmin and the Wamp64 Server is used in this project.

--Default PhpMyAdmin User/Pass for this project: User = "root", Pass = "toor".

--SQL code to insert database & table.
DROP DATABASE IF EXISTS record;
CREATE DATABASE record;
USE record;
DROP TABLE IF EXISTS emp_record;

CREATE TABLE `emp_record` (
 `employeeName` varchar(50) NOT NULL,
 `ssn` varchar(15) NOT NULL,
 `department` varchar(50) NOT NULL,
 `salary` int(10) NOT NULL,
 `homeaddress` varchar(300) NOT NULL,
 `id` int(10) NOT NULL AUTO_INCREMENT,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1
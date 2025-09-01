-- Database: students_reg_sys

DROP DATABASE IF EXISTS students_reg_sys;
CREATE DATABASE students_reg_sys;
USE students_reg_sys;

-- Table: majors
CREATE TABLE majors (
  major_id INT NOT NULL AUTO_INCREMENT,
  major_name VARCHAR(100) NOT NULL,
  PRIMARY KEY (major_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO majors (major_name) VALUES
('Information Science & Technology (IST)'),
('Computer Engineering (CE)'),
('Electronics Engineering (EcE)'),
('Precision Engineering (PrE)'),
('Advanced Material Engineering (AmE)');

-- Table: semester
CREATE TABLE semester (
  semester_id INT NOT NULL AUTO_INCREMENT,
  semester_name VARCHAR(50) NOT NULL,
  PRIMARY KEY (semester_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO semester (semester_name) VALUES
('First_Semester'),
('Second_Semester');

-- Table: year
CREATE TABLE year (
  year_id VARCHAR(20) NOT NULL,
  year_name VARCHAR(50) NOT NULL,
  PRIMARY KEY (year_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Table: fathers
CREATE TABLE fathers (
  father_id INT NOT NULL AUTO_INCREMENT,
  english_name VARCHAR(255) NOT NULL,
  myanmar_name VARCHAR(255) NOT NULL,
  nationality VARCHAR(100),
  religion VARCHAR(100),
  nrc VARCHAR(50),
  job VARCHAR(255),
  address TEXT,
  phone_number VARCHAR(20),
  date_of_death DATE,
  PRIMARY KEY (father_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Table: mothers
CREATE TABLE mothers (
  mother_id INT NOT NULL AUTO_INCREMENT,
  english_name VARCHAR(255) NOT NULL,
  myanmar_name VARCHAR(255) NOT NULL,
  nationality VARCHAR(100),
  religion VARCHAR(100),
  nrc VARCHAR(50),
  job VARCHAR(255),
  address TEXT,
  phone_number VARCHAR(20),
  date_of_death DATE,
  PRIMARY KEY (mother_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Table: dormitory
CREATE TABLE dormitory (
  dorm_id INT NOT NULL AUTO_INCREMENT,
  checking TINYINT(1) DEFAULT NULL,
  PRIMARY KEY (dorm_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Table: students
CREATE TABLE students (
  student_id VARCHAR(20) NOT NULL,
  std_nameMya VARCHAR(50) NOT NULL,
  std_nameEng VARCHAR(50) NOT NULL,
  std_seat_no VARCHAR(20) NOT NULL,
  std_nationality VARCHAR(100),
  std_religion VARCHAR(100),
  std_enroll_year VARCHAR(10),
  std_nrc VARCHAR(50),
  major_selections JSON,
  dob DATE,
  std_phone_number VARCHAR(20),
  std_email VARCHAR(40),
  std_address TEXT,
  father_id INT,
  mother_id INT,
  dorm_id INT,
  year_id VARCHAR(20),
  semester_id INT,
  major_id INT,
  PRIMARY KEY (student_id),
  CONSTRAINT fk_students_father FOREIGN KEY (father_id) REFERENCES fathers(father_id),
  CONSTRAINT fk_students_mother FOREIGN KEY (mother_id) REFERENCES mothers(mother_id),
  CONSTRAINT fk_students_dorm FOREIGN KEY (dorm_id) REFERENCES dormitory(dorm_id),
  CONSTRAINT fk_students_year FOREIGN KEY (year_id) REFERENCES year(year_id),
  CONSTRAINT fk_students_semester FOREIGN KEY (semester_id) REFERENCES semester(semester_id),
  CONSTRAINT fk_students_major FOREIGN KEY (major_id) REFERENCES majors(major_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

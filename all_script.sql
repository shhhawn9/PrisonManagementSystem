create table Prisoner(
  P_ID integer,
  P_Name varchar(30),
  Gender char(1),
  PRIMARY KEY(P_ID)
);

create table Prisoner_credit_status(
  performance_credit integer,
  status char(30),
  PRIMARY KEY(performance_credit)
);

create table Prisoner_job_credit(
  P_ID integer,
  Job varchar(30),
  performance_credit integer DEFAULT 0 CHECK (performance_credit >= -10 AND performance_credit <=
                                       10),
  primary key(P_ID),
  foreign key(P_ID) references Prisoner(P_ID)
    ON DELETE CASCADE,
  FOREIGN KEY(performance_credit) REFERENCES Prisoner_credit_status(performance_credit)
    ON DELETE NO ACTION
);

create table Cell_Block (
  Cell_ID Integer,
  Cell_Type char(30),
  PRIMARY KEY (Cell_ID)
);

create table Prisoner_cell(
  P_ID integer,
  Cell_ID integer NOT NULL,
  Sentence date,
  primary key(P_ID),
  foreign key(P_ID) references Prisoner(P_ID)
    ON DELETE CASCADE,
  foreign key(Cell_ID) references Cell_Block(Cell_ID)
    ON DELETE NO ACTION
    ON UPDATE CASCADE
);

CREATE TABLE Visitor_prisoner_relation(
  Visitor_ID integer,
  P_ID integer,
  relationship varchar(30),
  PRIMARY KEY (Visitor_ID, P_ID),
  FOREIGN KEY (P_ID) REFERENCES Prisoner(P_ID)
    ON DELETE CASCADE
);

CREATE TABLE Visitor(
	Visitor_ID integer,
	V_name varchar(30),
	PRIMARY KEY (Visitor_ID),
	FOREIGN KEY (Visitor_ID) REFERENCES Visitor_prisoner_relation(Visitor_ID)
    ON DELETE CASCADE
);

CREATE TABLE Administration (
	Employee_ID integer  PRIMARY KEY,
	Employee_name varchar(30),
	computer_ID integer,
	password char(30) NOT NULL
);

CREATE TABLE Schedule(
  Schedule_ID integer AUTO_INCREMENT,
  start_time datetime,
  end_time datetime,
  Employee_ID integer NOT NULL,
  PRIMARY KEY (Schedule_ID),
  FOREIGN KEY (Employee_ID) REFERENCES Administration(Employee_ID)
    ON DELETE CASCADE
);

CREATE TABLE Visiting (
  Schedule_ID integer  PRIMARY KEY,
  visiting_type  varchar(30),
  FOREIGN KEY (Schedule_ID) references Schedule(Schedule_ID)
    ON DELETE CASCADE
);

CREATE TABLE Working (
  Schedule_ID integer  PRIMARY KEY,
  working_type  varchar(30),
  FOREIGN KEY (Schedule_ID) references Schedule(Schedule_ID)
    ON DELETE CASCADE
);

CREATE TABLE Activity (
  Schedule_ID integer  PRIMARY KEY,
  activity_type varchar(30),
  FOREIGN KEY (Schedule_ID) references Schedule(Schedule_ID)
    ON DELETE CASCADE
);

CREATE TABLE Prisoner_follow_Schedule(
  P_ID integer,
  Schedule_ID integer,
  PRIMARY KEY (P_ID,Schedule_ID),
  FOREIGN KEY (P_ID) REFERENCES Prisoner (P_ID)
    ON DELETE CASCADE,
  FOREIGN KEY (Schedule_ID) REFERENCES Schedule(Schedule_ID)
    ON DELETE CASCADE
);

CREATE TABLE Facility_type(
  Schedule_ID integer,
  F_Type varchar(30),
  PRIMARY KEY (Schedule_ID),
  FOREIGN KEY (Schedule_ID) REFERENCES Schedule(Schedule_ID)
    ON DELETE CASCADE
);

CREATE TABLE Facility(
  F_ID integer,
  Schedule_ID integer,
  PRIMARY KEY (F_ID),
  FOREIGN KEY (Schedule_ID) REFERENCES Facility_type(Schedule_ID)
    ON DELETE SET NULL
	);

CREATE TABLE Reward_and_punishment(
	RP_ID integer primary key AUTO_INCREMENT,
	Description varchar(20)
);

CREATE TABLE Assign_RP (
	Employee_ID integer,
	RP_ID integer,
	PRIMARY KEY (Employee_ID, RP_ID),
	FOREIGN KEY(Employee_ID) REFERENCES Administration(Employee_ID)
    ON DELETE CASCADE,
	FOREIGN KEY(RP_ID) REFERENCES Reward_and_punishment(RP_ID)
    ON DELETE CASCADE
);

CREATE TABLE Prisoner_gets_RP (
	P_ID integer,
	RP_ID integer,
	PRIMARY KEY (P_ID, RP_ID),
	FOREIGN KEY(P_ID) REFERENCES Prisoner(P_ID)
    ON DELETE CASCADE,
	FOREIGN KEY(RP_ID) REFERENCES Reward_and_punishment(RP_ID)
    ON DELETE CASCADE
);

CREATE TABLE Routine(
  R_ID integer PRIMARY KEY,
  description varchar(50)
);

CREATE TABLE Correction_Officer(
  Officer_ID integer PRIMARY KEY,
  Officer_name varchar(30),
  taser_ID integer,
  supervisor_ID integer,
  R_ID integer,
  FOREIGN KEY (supervisor_ID) REFERENCES Correction_Officer (Officer_ID)
    ON DELETE SET NULL
    ON UPDATE CASCADE,
  FOREIGN KEY (R_ID) REFERENCES Routine (R_ID)
    ON DELETE SET NULL
    ON UPDATE CASCADE
);


CREATE TABLE Schedule_control_routine(
  R_ID integer,
  Schedule_ID integer,
  PRIMARY KEY(R_ID,Schedule_ID),
  FOREIGN KEY(R_ID) REFERENCES Routine(R_ID)
    ON UPDATE CASCADE,
  FOREIGN KEY(Schedule_ID) REFERENCES Schedule(Schedule_ID)
    ON UPDATE CASCADE
);

INSERT INTO `Prisoner_credit_status` (`performance_credit`, `status`)
  VALUES ('-10', 'terrible'),
         ('-9', 'terrible'),
         ('-8', 'terrible'),
         ('-7', 'terrible'),
         ('-6', 'terrible'),
         ('-5', 'bad'),
         ('-4', 'bad'),
         ('-3', 'bad'),
         ('-2', 'bad'),
         ('-1', 'bad'),
         ('0', 'ordinary'),
         ('10', 'excellent'),
         ('9', 'excellent'),
         ('8', 'excellent'),
         ('7', 'excellent'),
         ('6', 'excellent'),
         ('5', 'good'),
         ('4', 'good'),
         ('3', 'good'),
         ('2', 'good'),
         ('1', 'good');

INSERT INTO `Administration` (`Employee_ID`, `Employee_name`, `computer_ID`, `password`)
  VALUES ('19548197', 'Sharon Liu', '1', 'lxiaoran'),
         ('85611838', 'Shawn Gu', '2', 'Shawng92'),
         ('66411851', 'Kaining Zheng', '3', 'zkn1998');

INSERT INTO `Prisoner` (`P_ID`, `P_Name`, `Gender`)
  VALUES ('211081', 'Lei Wang', 'M'),
         ('341221', 'Guilin Zhang', 'M'),
         ('371422', 'Honghe Lu', 'M'),
         ('632122', 'Cunfu Zhao', 'M'),
         ('330124', 'Heying Ma', 'F'),
         ('321119', 'Annie Wang', 'F'),
         ('372822', 'Golden Zhang', 'M'),
         ('441881', 'Haixia Wang', 'F'),
         ('450121', 'Jennie Huang', 'F'),
         ('422422', 'Xianlong Hu', 'M');

INSERT INTO `Prisoner_job_credit` (`P_ID`, `Job`, `performance_credit`)
  VALUES ('321119', 'Officer', '6'),
         ('632122', 'Programmer', '2'),
         ('372822', 'Worker', '7'),
         ('341221', 'Teacher', '0'),
         ('441881', 'Farmer', '-1'),
         ('330124', 'Farmer', '-2'),
         ('371422', 'Fisher', '1'),
         ('450121', 'Worker', '-3'),
         ('211081', 'Officer', '0'),
         ('422422', 'CEO', '-8');

INSERT INTO `Cell_Block` (`Cell_ID`, `Cell_Type`)
  VALUES ('1', 'misdemeanor'),
         ('2', 'misdemeanor'),
         ('3', 'misdemeanor'),
         ('4', 'misdemeanor'),
         ('5', 'misdemeanor'),
         ('6', 'felony'),
         ('7', 'felony'),
         ('8', 'felony'),
         ('9', 'felony'),
         ('10', 'felony');

INSERT INTO `Prisoner_cell` (`P_ID`, `Cell_ID`, `Sentence`)
  VALUES ('321119', '1', '2022-06-06'),
         ('330124', '1', '2022-06-30'),
         ('441881', '6', '2060-09-01'),
         ('450121', '6', '2070-02-13'),
         ('211081', '2', '2025-04-14'),
         ('341221', '2', '2030-08-20'),
         ('371422', '7', '2080-01-20'),
         ('372822', '7', '2109-12-13'),
         ('632122', '7', '2077-10-06'),
         ('422422', '7', '2122-06-14');

INSERT INTO Routine (R_ID, description)
  VALUES (1, 'Outside Routine'),
         (2, 'Inside Routine');


INSERT INTO Correction_Officer (Officer_ID, Officer_name, taser_ID, supervisor_ID, R_ID)
  VALUES (100, 'Bruce Wayne', 1, null, 1),
         (101, 'Clark Kent', 2, 100, 2);
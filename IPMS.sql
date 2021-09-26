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
  PRIMARY KEY (F_ID, Schedule_ID),
  FOREIGN KEY (Schedule_ID) REFERENCES Facility_type(Schedule_ID)
    ON DELETE CASCADE
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
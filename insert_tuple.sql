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

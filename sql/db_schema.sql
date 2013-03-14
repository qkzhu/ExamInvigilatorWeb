-- create database ExamInvigilator

create table department(
	id int not null auto_increment,
	name varchar(64) not null,
	primary key(id)
)ENGINE=InnoDB;

create table student(
	id int not null auto_increment,
	student_number varchar(16) not null,
	student_name varchar(128) not null,
	ic_passport varchar(32) not null,
	gender char(1) not null,
	department int not null,
	enrol_year year not null,
	unique(student_number),
	primary key(id),
	foreign key(department) references department(id)
)ENGINE=InnoDB;

create table module(
	id int not null auto_increment,
	module_code varchar(32) not null,
	name varchar(128) not null,
	primary key(id)
)ENGINE=InnoDB;

create table map_student_module(
	student_id int not null,
	module_id int not null,
	primary key(student_id, module_id),
	foreign key(student_id) references student(id),
	foreign key(module_id) references module(id)
)ENGINE=InnoDB;

-- ******************************** REQUIRED sample data ********************************
insert into department(name) values('MAE');
insert into department(name) values('SCBE');
insert into department(name) values('CEE');
insert into department(name) values('SCE');
insert into department(name) values('SCE');
insert into department(name) values('EEE');
insert into department(name) values('MSE');

insert into module(module_code, name) values('HW001', 'ENGLISH PROFICIENCY');
insert into module(module_code, name) values('FE0001', 'FOUNDATION PHYSICS');
insert into module(module_code, name) values('EE2090', 'BASIC ENGINEERING MATHEMATICS');
insert into module(module_code, name) values('EETA', 'STRUCTURES & ALGORITHMS');
insert into module(module_code, name) values('HW210', 'TECHNICAL COMMUNICATION');
insert into module(module_code, name) values('EE2006', 'ENGINEERING MATHEMATICS I');
insert into module(module_code, name) values('EE2004', 'DIGITAL ELECTRONICS');
insert into module(module_code, name) values('EE2071', 'LABORATORY 2A');
insert into module(module_code, name) values('EE2002', 'ANALOG ELECTRONICS');
insert into module(module_code, name) values('EE2001', 'CIRCUIT ANALYSIS');
insert into module(module_code, name) values('EE2091', 'ENGINEERING PHYSICS');
insert into module(module_code, name) values('EE2072', 'LABORATORY 2B');
insert into module(module_code, name) values('EE2005', 'AC CIRCUITS & MACHINES');
insert into module(module_code, name) values('EE2003', 'SEMICONDUCTOR FUNDAMENTALS');
insert into module(module_code, name) values('EE3072', 'PROJECT');
insert into module(module_code, name) values('EE3003', 'INTEGRATED ELECTRONICS');
insert into module(module_code, name) values('EE3002', 'MICROPROCESSORS');
insert into module(module_code, name) values('EE2007', 'ENGINEERING MATHEMATICS II');
insert into module(module_code, name) values('EE3071', 'LABORATORY');
insert into module(module_code, name) values('EE3017', 'COMPUTER COMMUNICATIONS');
insert into module(module_code, name) values('EE3012', 'COMMUNICATION PRINCIPLES');
insert into module(module_code, name) values('EE3001', 'ENGINEERING ELECTROMAGNETICS');
insert into module(module_code, name) values('EE4761', 'COMPUTER NETWORKING');
insert into module(module_code, name) values('EE4717', 'WEB APPLICATION DESIGN');
insert into module(module_code, name) values('EE4079', 'FINAL YEAR PROJECT');
insert into module(module_code, name) values('EE4040', 'ENGINEERS AND SOCIETY');
insert into module(module_code, name) values('HW0310', 'PROFESSIONAL COMMUNICATION');
insert into module(module_code, name) values('EE4791', 'DATABASE SYSTEMS');
insert into module(module_code, name) values('EE4188', 'WIRELESS COMMUNICATIONS');
insert into module(module_code, name) values('EE4079', 'FINAL YEAR PROJECT');
insert into module(module_code, name) values('EE4001', 'SOFTWARE ENGINEERING');
insert into module(module_code, name) values('EE4152', 'DIGITAL COMMUNICATIONS');
insert into module(module_code, name) values('EE4105', 'CELLULAR COMMUNICATION SYSTEM DESIGN');
insert into module(module_code, name) values('EE4079', 'FINAL YEAR PROJECT');
insert into module(module_code, name) values('EE4041', 'HUMAN RESOURCE MANAGEMENT');
insert into module(module_code, name) values('EE4079', 'FINAL YEAR PROJECT');


create database  IF NOT EXISTS  `snake`;
use snake;

create table  IF NOT EXISTS  `people`
(
`id_p` int(20) unsigned not null auto_increment primary key,
`name` varchar(50),
`surname` varchar(50),
`birchday` date
);
 
create table  IF NOT EXISTS  `departament`
(
`id_d` int(20) unsigned not null auto_increment primary key,
`title` varchar(50)
);

create table  IF NOT EXISTS  `stafflist`
(
`id_s` int(20) unsigned not null auto_increment primary key,
`id_staff`  int(20) unsigned  not null,
`id_departament`  int(20) unsigned  not null,
`position` varchar(100),
`rate_type` enum ( "hour","month" )
);
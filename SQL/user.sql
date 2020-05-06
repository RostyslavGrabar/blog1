create DATABASE blog;

use blog;

CREATE TABLE `user` (
    Id int AUTO_INCREMENT PRIMARY KEY,
	Login varchar(50),
    Email varchar(50),
    `Password` varchar(50),
    `urlAvatar` varchar(255),
    `Role` varchar(50) DEFAULT NULL
);

create table record(
	Id int AUTO_INCREMENT PRIMARY KEY,
    Id_author int,
    `Date` varchar(25),
    Status boolean ,
    Text longtext,
    `Like` int default 0,
    `Dislike` int default 0
)

create table comment(
	Id int AUTO_INCREMENT PRIMARY KEY,
    IdAutor int,
    IdRecord int,
    `Date` varchar(25),
    Status boolean ,
    Text longtext,
    `Like` int default 0,
    `Dislike` int default 0
)
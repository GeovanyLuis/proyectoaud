CREATE DATABASE IF NOT exists twofactor;

CREATE TABLE IF NOT exists users ( 
id int primary key auto_increment,
name varchar(255) not null,
email varchar (255) not null unique,
password varchar (255) not null, 
two_factor_key varchar (255) null
);


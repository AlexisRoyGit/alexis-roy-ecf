CREATE DATABASE restaurant;

USE restaurant;

CREATE TABLE admins (
    id_admin char(36) not null primary key,
    email_admin varchar(254) not null,
    password_admin varchar(255) not null
);

CREATE TABLE clients (
    id_client char(36) not null primary key,
    email_client varchar(254) not null,
    password_client varchar(255) not null,
    number_guests int(2) not null,
    allergies varchar(150)
);

CREATE TABLE hours (
    days int(11) auto_increment not null primary key,
    hoursNoon varchar(15),
    hoursEvening varchar(15),
    isClosed tinyint(1) default 0 
);

CREATE TABLE images_courses (
    id_image int(11) auto_increment not null primary key,
    title varchar(150) not null,
    name varchar(150) not null
);

CREATE TABLE reservation (
    id_reservation char(36) not null primary key,
    date char(10) not null,
    hour char(5) not null,
    guests int(2) not null,
    allergies varchar(150),
    limit_capacity int(3) not null default 100
);
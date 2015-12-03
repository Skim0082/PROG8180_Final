CREATE DATABASE RideShareDB;
USE RideShareDB;


CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	firstname VARCHAR(255) NOT NULL,
	lastname VARCHAR(255) NOT NULL,
	nickname VARCHAR(255) NOT NULL,
	sex CHAR(1) NOT NULL,
	isSmoking INT(1) NOT NULL,
	contactDetail VARCHAR(255) NOT NULL,
	vehicle VARCHAR(255) NOT NULL,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL,
	UNIQUE KEY (email),
	CHECK (role = 'admin' OR role = 'user'),
    CHECK (sex = 'M' OR sex = 'F')
);


CREATE TABLE posts (
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id INT UNSIGNED,
	postType INT UNSIGNED,
	seatsAvailable INT(2) UNSIGNED,
	costPerPerson DECIMAL(10,2),
	preferredContact VARCHAR(255) NOT NULL,
	departureDate CHAR(10),
	departureTime CHAR(8),
	srcStreet VARCHAR(255) NOT NULL,
	srcCity VARCHAR(255) NOT NULL,
	srcPostal CHAR(7) NOT NULL,
	dstStreet VARCHAR(255) NOT NULL,
	dstCity VARCHAR(255) NOT NULL,
	dstPostal CHAR(7) NOT NULL,	
	FOREIGN KEY user_key(user_id) REFERENCES users(id)
);

CREATE TABLE comments (
	post_id INT UNSIGNED,
	user_id INT UNSIGNED,
	body VARCHAR(255) NOT NULL,
	isApproved INT(1) NOT NULL,

	FOREIGN KEY (post_id) 
	REFERENCES posts(id),
	
	FOREIGN KEY (user_id) 
	REFERENCES users(id),
	
	CONSTRAINT Users_Comments_PK
	PRIMARY KEY (post_id, user_id)
)
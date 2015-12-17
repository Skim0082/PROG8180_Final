CREATE DATABASE RideShareDB;
USE RideShareDB;




CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    role VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	firstname VARCHAR(255) NOT NULL,
	lastname VARCHAR(255) NOT NULL,
	username VARCHAR(255) NOT NULL,
	gender CHAR(1) NOT NULL,
	isSmoking INT(1) NOT NULL,
	contactDetail VARCHAR(255) NOT NULL,
	vehicle VARCHAR(255) NOT NULL,
    facebood_id VARCHAR(20) NOT NULL,
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
	srcAddr VARCHAR(255) NOT NULL,
	srcLongitude float NOT NULL,
    srcLatitude float NOT NULL,
	dstAddr VARCHAR(255) NOT NULL,
    dstLongitude float NOT NULL,
    dstLatitude float NOT NULL,
	FOREIGN KEY user_key(user_id) REFERENCES users(id)
    created DATETIME NOT NULL,
    modifed DATETIME NOT NULL
);

CREATE TABLE comments (
	post_id INT UNSIGNED,
	user_id INT UNSIGNED,
	body VARCHAR(255) NOT NULL,
	approved INT(1) NOT NULL,
    created DATETIME NOT NULL,
    modifed DATETIME NOT NULL,
    
	FOREIGN KEY (post_id) 
	REFERENCES posts(id),
	
	FOREIGN KEY (user_id) 
	REFERENCES users(id),
	
	CONSTRAINT Users_Comments_PK
	PRIMARY KEY (post_id, user_id)
);

CREATE TABLE tags (
  id  INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(20) NOT NULL
);

CREATE TABLE poststags (
    tag_id  INT UNSIGNED,
    post_id INT UNSIGNED,
    
    FOREIGN KEY (post_id) 
	REFERENCES posts(id),
	
	FOREIGN KEY (tag_id) 
	REFERENCES tags(id),
	
	CONSTRAINT Posts_Tags_PK
	PRIMARY KEY (post_id, tag_id)
)
create database uplink_test;
grant all on uplink_test.* to 'uplink_test'@'localhost' identified by 'uplink_test';
flush privileges;

CREATE TABLE user_right(
	id int(11) NOT NULL auto_increment,
	user_id int(11) NOT NULL,
	unlocked boolean NOT NULL,
	right1 boolean NOT NULL,
	right2 boolean NOT NULL,	
	FOREIGN KEY(user_id)REFERENCES user(id),
	PRIMARY KEY (id)
);

CREATE TABLE user (
	id int(11) NOT NULL auto_increment,
	firstname varchar(50) NOT NULL,
	lastname varchar(50) NOT NULL,
	password varchar(15) NOT NULL,	
	PRIMARY KEY (id)
);




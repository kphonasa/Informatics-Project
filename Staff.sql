DROP TABLE IF EXISTS STAFF;

CREATE TABLE STAFF(
	STAFFID INT NOT NULL AUTO_INCREMENT,
	EMAIL VARCHAR(100) NOT NULL,
	HASHEDPASS VARCHAR(255) NOT NULL,
	ADMIN BOOLEAN NOT NULL,
	PRIMARY KEY (STAFFID)
);
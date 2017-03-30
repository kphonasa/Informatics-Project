DROP TABLE IF EXISTS USERS1;
DROP TABLE IF EXISTS STAFF;
DROP TABLE IF EXISTS STORE;
DROP TABLE IF EXISTS CATEGORY;
DROP TABLE IF EXISTS PRODUCT;
DROP TABLE IF EXISTS ORDERS;


CREATE TABLE USERS1(
	ID INT NOT NULL AUTO_INCREMENT,
	EMAIL VARCHAR(128) NOT NULL,
	HASHEDPASS VARCHAR(255) NOT NULL,
	FNAME VARCHAR (25),
	LNAME VARCHAR (25),
	STREET VARCHAR (128),
	CITY VARCHAR (128),
	USSTATE VARCHAR (128),
	ZIP VARCHAR (5) NOT NULL,
	PHONE VARCHAR (11) NOT NULL,
	CARDNAME VARCHAR(128),
	CARDNUMBER INT (16),
	EXMONTH INT (2),
	EXYEAR INT (2),
	CCV INT (3),
	PRIMARY KEY (ID)
);


CREATE TABLE STORE(
    ID INT NOT NULL AUTO_INCREMENT,
    NAME VARCHAR(128) NOT NULL,
    URL VARCHAR(128) NOT NULL,
	PRIMARY KEY (ID)
);

CREATE TABLE CATEGORY(
    ID INT NOT NULL AUTO_INCREMENT,
    STOREID INT NOT NULL,
    NAME VARCHAR(128) NOT NULL,
	PRIMARY KEY (ID)
);

CREATE TABLE PRODUCT(
    ID INT NOT NULL AUTO_INCREMENT,
    STOREID INT NOT NULL,
    NAME VARCHAR(128) NOT NULL,
    DESCRIPTION VARCHAR(255) NOT NULL,
    IMAGE VARCHAR(128) NOT NULL,
    CATEGORY VARCHAR(20) NOT NULL,
    PRICE INT NOT NULL,
    QTY INT NOT NULL,
	PRIMARY KEY(ID)
);

CREATE TABLE ORDERS(
    ID INT NOT NULL AUTO_INCREMENT,
    USERID INT NOT NULL,
    PRODUCTID INT NOT NULL,
    STOREID INT NOT NULL,
    ORDERDATE VARCHAR(20) NOT NULL,
    STATUS VARCHAR(128) NOT NULL,
    TOTALP INT NOT NULL,
	PRIMARY KEY (ID)
);

CREATE TABLE STAFF(
	STAFFID INT NOT NULL AUTO_INCREMENT,
    STOREID INT NOT NULL,
	EMAIL VARCHAR(128) NOT NULL,
	HASHEDPASS VARCHAR(255) NOT NULL,
	ISADMIN BOOLEAN NOT NULL,
	PRIMARY KEY (STAFFID)
);

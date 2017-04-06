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
	FNAME VARCHAR (25) NOT NULL,
	LNAME VARCHAR (25) NOT NULL,
	STREET VARCHAR (128) NOT NULL,
	CITY VARCHAR (128) NOT NULL,
	USSTATE VARCHAR (128) NOT NULL,
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
    CNAME VARCHAR(128) NOT NULL,
	PRIMARY KEY (ID)
);

CREATE TABLE PRODUCT(
    ID INT NOT NULL AUTO_INCREMENT,
    STOREID INT NOT NULL,
    PNAME VARCHAR(128) NOT NULL,
    DESCRIPTION VARCHAR(255),
    IMAGE VARCHAR(128),
    CATEGORY VARCHAR(20),
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

insert into STORE(NAME,URL) VALUES ('STORE1','https://webdev.cs.uiowa.edu/~xli165/project/STORE1.php');


insert into CATEGORY(STOREID,CNAME) VALUES (1,'vegetable');
insert into CATEGORY(STOREID,CNAME) VALUES (2,'toy');
insert into PRODUCT(STOREID,PNAME,IMAGE,CATEGORY,PRICE,QTY) VALUES (1,'cucumber','images/cucumbers.jpg','vegetable',1,50);
insert into PRODUCT(STOREID,PNAME,IMAGE,CATEGORY,PRICE,QTY) VALUES (1,'tomato','images/tomato.jpg','vegetable',1,50);
insert into PRODUCT(STOREID,PNAME,IMAGE,CATEGORY,PRICE,QTY) VALUES (1,'lettuce','images/lettuce.jpg','vegetable',1,50);


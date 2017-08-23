DROP TABLE IF EXISTS USERS1;
DROP TABLE IF EXISTS STAFF;
DROP TABLE IF EXISTS STORE;
DROP TABLE IF EXISTS CATEGORY;
DROP TABLE IF EXISTS PRODUCT;
DROP TABLE IF EXISTS ORDERS;
DROP TABLE IF EXISTS ORDERDETAILS;
DROP TABLE IF EXISTS TEMP;


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
    CATEGORYID INT UNSIGNED  NOT NULL,
    PNAME VARCHAR(128) NOT NULL,
    DESCRIPTION VARCHAR(255),
    IMAGE VARCHAR(128),
    PRICE INT NOT NULL,
    QTY INT NOT NULL,
	PRIMARY KEY(ID)
);

CREATE TABLE ORDERS(
    ID INT NOT NULL AUTO_INCREMENT,
    USERID INT,
	FNAME VARCHAR (25) NOT NULL,
	LNAME VARCHAR (25) NOT NULL,
	STREET VARCHAR (128) NOT NULL,
	CITY VARCHAR (128) NOT NULL,
	USSTATE VARCHAR (128) NOT NULL,
	ZIP VARCHAR (5) NOT NULL,
	PHONE VARCHAR (11) NOT NULL,
    STOREID INT NOT NULL,
    ORDERDATE DATE NOT NULL,
	ORDERTIME TIME NOT NULL,
	CARDNAME VARCHAR(128),
	CARDNUMBER INT (16),
	EXMONTH INT (2),
	EXYEAR INT (2),
	CCV INT (3),
    STATUS VARCHAR(128) NOT NULL,
    TOTALP INT NOT NULL,
	PRIMARY KEY (ID)
);

CREATE TABLE ORDERDETAILS(
	ID INT NOT NULL,
	ORDERID INT NOT NULL,
	PRODUCTID INT NOT NULL,
	QTY INT NOT NULL,
	PRICE INT NOT NULL,
	PRIMARY KEY(ID)
);
CREATE TABLE STAFF(
	STAFFID INT NOT NULL AUTO_INCREMENT,
    STOREID INT NOT NULL,
	EMAIL VARCHAR(128) NOT NULL,
	HASHEDPASS VARCHAR(255) NOT NULL,
	ISADMIN BOOLEAN NOT NULL,
	PRIMARY KEY (STAFFID)
);
CREATE TABLE TEMP(
	ID INT NOT NULL AUTO_INCREMENT,
	PNAME VARCHAR(128) NOT NULL,
	PRODUCTID INT NOT NULL,
	QTY INT NOT NULL,
	PRICE INT NOT NULL,
	EMAIL VARCHAR(128),
	COOKIE VARCHAR(128),
	PRIMARY KEY(ID)
);

insert into STORE(NAME,URL) VALUES ('STORE1','https://webdev.cs.uiowa.edu/~xli165/project/STORE1.php');
insert into ORDERS(USERID,PRODUCTID,STOREID,ORDERDATE,STATUS,TOTALP) VALUES(5,4,1,'09/08/17','ORDER PLACED',100);


insert into CATEGORY(STOREID,CNAME) VALUES (1,'vegetable');
insert into CATEGORY(STOREID,CNAME) VALUES (2,'toy');
insert into PRODUCT(STOREID,CATEGORYID,PNAME,IMAGE,PRICE,QTY) VALUES (1,1,'cucumber','images/cucumbers.jpg',1,50);
insert into PRODUCT(STOREID,CATEGORYID,PNAME,IMAGE,PRICE,QTY) VALUES (1,1,'tomato','images/tomato.jpg',1,50);
insert into PRODUCT(STOREID,CATEGORYID,PNAME,IMAGE,PRICE,QTY) VALUES (1,1,'lettuce','images/lettuce.jpg',1,50);
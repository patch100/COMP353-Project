CREATE DATABASE IF NOT EXISTS comp353_warmup;

# Switches to the comp353_warmup db.
use comp353_warmup;

CREATE TABLE Customer(
	cNumber		INT			NOT NULL,
	cName		VARCHAR(20) NOT NULL,
	cAddress	VARCHAR(30) NOT NULL,
	cPhone		VARCHAR(12) NOT NULL,
	PRIMARY KEY(cNumber)
);

CREATE TABLE Manufacturer(
	mNumber		INT			NOT NULL,
	mName		VARCHAR(20) NOT NULL,
	mAddress	VARCHAR(30) NOT NULL,
	mManager	VARCHAR(20) NOT NULL,
	mPhone		VARCHAR(12) NOT NULL,
	PRIMARY KEY(mNumber)
);

CREATE TABLE Product(
	pNumber		INT			NOT NULL,
	mNumber		INT 		NOT NULL,
	pName		VARCHAR(30) NOT NULL,
	pUnitPrice	FLOAT(10) 	NOT NULL,
	PRIMARY KEY(pNumber, mNumber)
);

CREATE TABLE Shippment(
	oNumber			INT			NOT NULL,
	cNumber			INT			NOT NULL,
	sDate			VARCHAR(30) NOT NULL,
	receivedDate	VARCHAR(30) NOT NULL,
	PRIMARY KEY(oNumber)
);

CREATE TABLE OrderDetail(
	oNumber		INT			NOT NULL,
	oDate		VARCHAR(30) NOT NULL,
	detailNo	INT			NOT NULL,
	pNumber		INT			NOT NULL,
	oQuantity	INT 		NOT NULL,
	Cost		FLOAT(10)	NOT NULL,
	PRIMARY KEY(oNumber, detailNo)
);
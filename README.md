PostBox-2.0
===========

Improved version of already existing postbox


Steps to generate MySQL database for this website

login
- userID/username
- password
- blockflag ( i.e. true if blocked)
- level ( i.e. 0 is superadmin, 1 is admin, 2 is subadmin, 3 is member)
 
userinfo
- userID/username
- firstname
- lastname
- age
- sex (i.e. true if female and male otherwise)
- DOB
- emailID
- photo (optional)
 
groups
- groupname
- groupID
- groupadmin
- subgroupID 

subgroups
- subgroupname
- subgroupID
- subgroupadmin
 
post
- subgroupID
- userID/username
- text
- postdate (YYYY-MM-DD)

member 
- userID/username
- subgroupID

personal
- fromID
- toID
- text
- postdate


//////////////////////////////////////////////////////////////////////////////////////////

CREATE DATABASE postbox;

create table userinfo ( userID INT NOT NULL AUTO_INCREMENT, firstname varchar(100), lastname varchar(100), age INT, sex BOOLEAN, emailID varchar(100), DOB date, PRIMARY KEY (userID) )

create table login ( userID INT, password varchar(100), blockflag BOOLEAN, level INT,  PRIMARY KEY (userID), FOREIGN KEY (userID) REFERENCES userinfo(userID) );

create table subgroups ( subgroupID INT NOT NULL AUTO_INCREMENT, subgroupname varchar(100), subgroupadmin INT NOT NULL, PRIMARY KEY(subgroupID), FOREIGN KEY (subgroupadmin) REFERENCES login(userID))

create table groups ( groupID INT NOT NULL, groupname varchar(100), groupadmin INT NOT NULL, subgroupID INT, FOREIGN KEY (groupadmin) REFERENCES login(userID), FOREIGN KEY (subgroupID) REFERENCES subgroups(subgroupID))

create table post ( userID INT, text varchar(1000), subgroupID INT, postdate date, FOREIGN KEY (userID) REFERENCES userinfo(userID), FOREIGN KEY (subgroupID) REFERENCES subgroups(subgroupID) )

create table member ( userID INT, subgroupID INT, FOREIGN KEY (userID) REFERENCES login(userID), FOREIGN KEY (subgroupID) REFERENCES subgroups(subgroupID) )

create table personal ( fromID INT, toID INT, text varchar(1000), postdate date, FOREIGN KEY (fromID) REFERENCES userinfo(userID), FOREIGN KEY (toID) REFERENCES userinfo(userID));

//////////////////////////////////////////////////////////////////////////////////////////


INSERT INTO userinfo (firstname, lastname, age, sex, emailID, DOB) VALUES ('John', 'Doe', 21, false,'john@gmail.com','1992-05-25');
INSERT INTO userinfo (firstname, lastname, age, sex, emailID, DOB) VALUES ('Matt', 'Harvey', 31, false,'matt@gmail.com','1982-05-08');
INSERT INTO userinfo (firstname, lastname, age, sex, emailID, DOB) VALUES ('Steve', 'Jobs', 26, false,'steve@gmail.com','1971-03-12');
INSERT INTO userinfo (firstname, lastname, age, sex, emailID, DOB) VALUES ('Billy', 'Gates', 23, false,'billy@gmail.com','1992-01-05');
INSERT INTO userinfo (firstname, lastname, age, sex, emailID, DOB) VALUES ('Chris', 'Dent', 22, false,'chris@gmail.com','1998-08-30');
INSERT INTO userinfo (firstname, lastname, age, sex, emailID, DOB) VALUES ('Jim', 'Crawford', 18, false,'jim@gmail.com','1996-11-27');
INSERT INTO userinfo (firstname, lastname, age, sex, emailID, DOB) VALUES ('Ryan', 'Fitzer', 19, false,'ryan@gmail.com','1984-02-15');

//////////////////////////////////////////////////////////////////////////////////////////

	INSERT INTO login VALUES (1, 'john_pass', false, 0);
	INSERT INTO login VALUES (2, 'matt_pass', false, 1);
	INSERT INTO login VALUES (3, 'steve_pass', true, 3);
	INSERT INTO login VALUES (4, 'billy_pass', false, 2);
	INSERT INTO login VALUES (5, 'chris_pass', false, 2);
	INSERT INTO login VALUES (6, 'jim_pass', false, 2);
	INSERT INTO login VALUES (7, 'ryan_pass', false, 3);

//////////////////////////////////////////////////////////////////////////////////////////

ALTER TABLE subgroups AUTO_INCREMENT=100;

INSERT INTO subgroups (subgroupadmin, subgroupname) VALUES (6, 'Art Club');
INSERT INTO subgroups (subgroupadmin, subgroupname) VALUES (6, 'Music Club');
INSERT INTO subgroups (subgroupadmin, subgroupname) VALUES (4, 'Literary Club');
INSERT INTO subgroups (subgroupadmin, subgroupname) VALUES (5, 'Dance Club');
INSERT INTO subgroups (subgroupadmin, subgroupname) VALUES (4, 'Drama Club');

//////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO groups (groupID, groupadmin, groupname, subgroupID) VALUES (1000, 2, 'Cultural Council', 100);
INSERT INTO groups (groupID, groupadmin, groupname, subgroupID) VALUES (1000, 2, 'Cultural Council', 101);
INSERT INTO groups (groupID, groupadmin, groupname, subgroupID) VALUES (1000, 2, 'Cultural Council', 102);
INSERT INTO groups (groupID, groupadmin, groupname, subgroupID) VALUES (1000, 2, 'Cultural Council', 103);
INSERT INTO groups (groupID, groupadmin, groupname, subgroupID) VALUES (1000, 2, 'Cultural Council', 104);

//////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO member (userID, subgroupID) VALUES (3, 100);
INSERT INTO member (userID, subgroupID) VALUES (7, 103);

//////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO post (userID, text, subgroupID, postdate) VALUES (3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes', 100, CURDATE());

INSERT INTO post (userID, text, subgroupID, postdate) VALUES (3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes', 100, CURDATE());

INSERT INTO post (userID, text, subgroupID, postdate) VALUES (3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes', 100, CURDATE());

INSERT INTO post (userID, text, subgroupID, postdate) VALUES (3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes', 100, CURDATE());

INSERT INTO post (userID, text, subgroupID, postdate) VALUES (3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes', 100, CURDATE());

INSERT INTO post (userID, text, subgroupID, postdate) VALUES (3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes', 100, CURDATE());

INSERT INTO post (userID, text, subgroupID, postdate) VALUES (3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes', 100, CURDATE());

INSERT INTO post (userID, text, subgroupID, postdate) VALUES (3, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes', 100, CURDATE());

INSERT INTO post (userID, text, subgroupID, postdate) VALUES (7, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes', 103, CURDATE());

INSERT INTO post (userID, text, subgroupID, postdate) VALUES (7, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes', 103, CURDATE());

INSERT INTO post (userID, text, subgroupID, postdate) VALUES (7, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes', 103, CURDATE());

INSERT INTO post (userID, text, subgroupID, postdate) VALUES (7, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes', 103, CURDATE());

INSERT INTO post (userID, text, subgroupID, postdate) VALUES (7, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes', 103, CURDATE());

INSERT INTO post (userID, text, subgroupID, postdate) VALUES (7, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes', 103, CURDATE());


//////////////////////////////////////////////////////////////////////////////////////////

INSERT INTO personal VALUES (3, 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', CURDATE());
INSERT INTO personal VALUES (3, 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', CURDATE());
INSERT INTO personal VALUES (4, 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', CURDATE());
INSERT INTO personal VALUES (2, 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', CURDATE());
INSERT INTO personal VALUES (3, 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', CURDATE());
INSERT INTO personal VALUES (2, 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', CURDATE());
INSERT INTO personal VALUES (2, 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', CURDATE());
INSERT INTO personal VALUES (2, 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.', CURDATE());

//////////////////////////////////////////////////////////////////////////////////////////

select firstname, text, subgroupname, postdate
from post
left join userinfo on post.userID = userinfo.userID 
left join subgroups on post.subgroupID = subgroups.subgroupID

//////////////////////////////////////////////////////////////////////////////////////////

insert into Employee
values
(1,123456789,'Alex Stone','514-123-4567','astone@gmail.com','1991-12-8','50 Charming street', 'Janitor'),
(2,987654321,'Martha Landry','514-444-4587','mlandry@gmail.com','1984-10-2','15 Lake road', 'Sales Rep'),
(3,456789123,'Dan Gryte','514-138-9967','dgryte@gmail.com','1959-2-3','123 Downey', 'IT'),
(4,467315648,'Meredith Cambell','514-489-2365','mcambell@gmail.com','1971-3-8','5978 Ontario street', 'Human Resources'),
(5,582645948,'Roger White','879-468-5987','rogerrabbit@gmail.com','1945-10-9','78 Conway boulevard', 'Accountant'),
(6,784452135,'Chris Lee','514-448-6233','clee@gmail.com','1969-1-27','64 Redlowe', 'Shipping'),
(7,745631223,'John Cena','514-195-7586','jcena@gmail.com','1982-9-13','1258 Prince Arthur', 'Sales Rep'),
(8,134688995,'Jason Wang','514-875-9995','jwang@gmail.com','1968-5-5','756 Caledonia', 'Customer Service'),
(9,324515578,'Ella Smith','514-876-4447','esmith@gmail.com','1971-6-24','655 Rocky road', 'Delivery'),
(10,456879955,'Jannice Redmond','514-123-4887','jredmond@gmail.com','1989-2-18','582 Tulip', 'Secretary'),
(11,789463155,'Dave Gravell','514-889-9187','dgravell@gmail.com','1992-1-23','4 Ducan avenue', 'Human Resources');

insert into FullTimeEmployee
values
(1,35000),
(3,80000),
(4,65300),
(5,65300),
(7,44600),
(8,78350),
(9,90400);

insert into PartTimeEmployee
values
(2,26.48,25),
(6,34.21,18),
(10,25.72,25);

insert into EmployeeDependant
values
(456238974,'Jerome Lee','1999-7-30'),
(456879233,'Vicky Cambell','2008-12-2'),
(582642999,'Sara Cambell','2010-4-20'),
(111135489,'Adolphus Gryte','1943-5-14'),
(135559846,'Kevin McCallister','2005-2-9');

insert into IsCareGiver
values
(6,456238974),
(4,456879233),
(4,582642999),
(3,111135489),
(7,135559846);

insert into Department
values
(1,'Production','514-448-9633',NULL,5,'894-555-4648'),
(2,'Human Resources','514-448-9873','489-446-1325',8,NULL),
(3,'Accounting','514-448-1158',NULL,18,'894-489-3156'),
(4,'Sales','514-844-1987','499-448-1321',9,NULL),
(5,'Administration','514-448-4999',NULL,2,'894-336-4648'),
(6,'Research and Development','514-497-9633','488-999-7775',11,'894-711-4648');

insert into HasEmployees
values
(2,1,false,'1999-6-7',NULL),
(4,2,true,'2005-12-7',NULL),
(6,3,true,'2001-6-12',NULL),
(2,4,true,'1999-6-7','2009-10-21'),
(3,5,false,'2006-4-18',NULL),
(1,6,false,'2001-7-6', '2006-2-19'),
(4,7,false,'2005-11-9',NULL),
(4,8,false,'2007-6-3',NULL),
(1,9,false,'2007-6-3', NULL),
(5,10,false,'1999-6-7',NULL),
(2,11,true, '2009-10-21',NULL);

insert into Customer
values
(1,'Mike Tyson','446-464-4487', '1972-4-9'),
(2,'Greg Downey','485-119-4618', '1994-7-18'),
(3,'Stella Artois','458-225-6644', '1968-12-31'),
(4,'Mitch Paxton','446-481-1135', '1987-5-17'),
(5,'Nancy Ward','795-111-4897', '1989-3-18'),
(6,'Collin Micheals','481-136-1197', '1962-4-9'),
(7,'Julie Martin','484-181-1818', '1982-7-7'),
(8,'Christine Long','632-644-8882', '1966-10-30');

insert into Orders
values
(1,'FULL','2015-10-12',0),
(2,'INSTALLMENT','2015-5-9',12.58),
(3,'FULL','2015-1-22',119.36),
(4,'FULL','2015-8-4',58.15),
(5,'INSTALLMENT','2015-10-12',0),
(6,'FULL','2015-5-10',900.42),
(7,'FULL','2015-8-12',7000.48),
(8,'INSTALLMENT','2016-3-3',0);

insert into HasOrdered
values
(1,1),
(2,3),
(3,5),
(4,7),
(5,2),
(6,4),
(7,6),
(8,8);

insert into Payment
values
(1,'2015-12-27',48.25),
(2,'2015-9-9',84.75),
(5,'2015-11-14',115.48),
(5,'2015-11-3',115.48),
(8,'2016-3-15',48.25),
(8,'2016-3-30',48.25);

insert into Colors
values
('red'),
('blue'),
('yellow'),
('orange'),
('green'),
('white'),
('purple'),
('pink');

insert into Item
values
(1,'lego'),
(2,'magical dragons'),
(3,'choochoo train'),
(4,'candyland'),
(5,'army fighters'),
(6,'ultra twinkly princess dolls');

insert into HasColor
values
(1,'red'),
(1,'blue'),
(2,'green'),
(3,'orange'),
(3,'red'),
(3,'blue'),
(4,'white'),
(4,'purple'),
(5,'green'),
(2,'white'),
(2,'purple'),
(2,'pink');

insert into Inventory
values
(1,12.54,'2006-4-15',100),
(2,112.36,'2006-4-15',50),
(3,36.48,'2008-1-14',300),
(4,74.84,'2010-3-28',25),
(5,5.69,'2007-12-6',36),
(6,25.48,'2010-5-3',8000);

insert into ItemsOrdered
values
(1,2,5),
(1,3,3),
(2,6,2),
(3,5,1),
(3,1,4),
(4,1,6),
(4,2,7),
(4,3,2),
(5,5,6),
(6,4,12),
(7,6,3),
(7,2,1),
(8,3,2),
(8,1,1),
(8,5,6),
(8,6,15);
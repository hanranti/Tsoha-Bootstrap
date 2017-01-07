-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Visitor (name, password) VALUES ('Kalle', 'Kalle123');
INSERT INTO Visitor (name, password) VALUES ('Henri', 'Henri123');
INSERT INTO Chore (name, info, deadline, importancedegree, visitorid) VALUES ('Askare', 'tietoa', '2016-12-30', '10', '1');
INSERT INTO Chore (name, info, deadline, importancedegree, visitorid) VALUES ('Askare2', 'tietoa2', '2014-11-30', '11', '1');
INSERT INTO Chore (name, info, deadline, importancedegree, visitorid) VALUES ('Askare3', 'tietoa3', '2018-12-30', '44', '1');
INSERT INTO Chore (name, info, deadline, importancedegree, visitorid) VALUES ('Askare4', 'tietoa4', '2017-01-03', '66', '1');
INSERT INTO Chore (name, info, deadline, importancedegree, visitorid) VALUES ('Askare5', 'tietoa5', '2018-07-07', '92', '1');
INSERT INTO Chore (name, info, deadline, importancedegree, visitorid) VALUES ('Askare6', 'info', '2018-01-01', '3', '2');
INSERT INTO Category (name) VALUES ('tyo');
INSERT INTO Category (name) VALUES ('opiskelu');
INSERT INTO ChoreCategory (Choreid, Category) VALUES ('1', 'tyo');
INSERT INTO ChoreCategory (Choreid, Category) VALUES ('2', 'opiskelu');

-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Visitor (name, password) VALUES ('Kalle', 'Kalle123');
INSERT INTO Visitor (name, password) VALUES ('Henri', 'Henri123');
INSERT INTO Chore (name, info, deadline, importancedegree, visitorid) VALUES ('Askare', 'tietoa', '2016-12-30', '10', '1');
INSERT INTO Chore (name, info, deadline, importancedegree, visitorid) VALUES ('Askare2', 'info', '2018-01-01', '3', '2');
INSERT INTO Category (name) VALUES ('tyo');
INSERT INTO Category (name) VALUES ('opiskelu');
INSERT INTO ChoreCategory (Choreid, Category) VALUES ('1', 'tyo');
INSERT INTO ChoreCategory (Choreid, Category) VALUES ('2', 'opiskelu');

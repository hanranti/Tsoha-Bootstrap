-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja (name, password) VALUES ('Kalle', 'Kalle123');
INSERT INTO Kayttaja (name, password) VALUES ('Henri', 'Henri123');
INSERT INTO Askare (name, info, deadline, tarkeysaste, kayttaja) VALUES ('Askare', 'tietoa', '2016-12-30', '10', 'Kalle');
INSERT INTO Askare (name, info, deadline, tarkeysaste, kayttaja) VALUES ('Askare2', 'info', '2018-01-01', '3', 'Henri');
INSERT INTO Luokka (name) VALUES ('tyo');
INSERT INTO Luokka (name) VALUES ('opiskelu');
INSERT INTO Muistilista (name) VALUES ('tyo ja opiskelu');
INSERT INTO AskareMuistilista (askareid, muistilistaid) VALUES (SELECT id FROM Askare WHERE name='Askare', SELECT id FROM Muistilista WHERE name='tyo ja opiskelu');
INSERT INTO AskareLuokka (askareid, luokkaid) VALUES (SELECT id FROM Askare WHERE name='Askare', SELECT id FROM Luokka WHERE name='tyo');
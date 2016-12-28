-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja (name, password) VALUES ('Kalle', 'Kalle123');
INSERT INTO Kayttaja (name, password) VALUES ('Henri', 'Henri123');
INSERT INTO Askare (name, info, deadline, tarkeysaste, kayttaja) VALUES ('Askare', 'tietoa', '2016-12-30', '10', 'Kalle');
INSERT INTO Askare (name, info, deadline, tarkeysaste, kayttaja) VALUES ('Askare2', 'info', '2018-01-01', '3', 'Henri');
INSERT INTO Luokka (name) VALUES ('tyo');
INSERT INTO Luokka (name) VALUES ('opiskelu');
INSERT INTO Muistilista (name, kayttaja) VALUES ('tyo ja opiskelu', 'Kalle');
INSERT INTO Muistilista (name, kayttaja) VALUES ('opiskelu', 'Henri');
INSERT INTO AskareMuistilista (askareid, muistilistaid) VALUES ('1', '1');
INSERT INTO AskareMuistilista (askareid, muistilistaid) VALUES ('2', '2');
INSERT INTO AskareLuokka (askareid, luokka) VALUES ('1', 'tyo');
INSERT INTO AskareLuokka (askareid, luokka) VALUES ('2', 'opiskelu');

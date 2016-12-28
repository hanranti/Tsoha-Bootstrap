-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja(
  name varchar(50) PRIMARY KEY NOT NULL,
  password varchar(50) NOT NULL
);
CREATE TABLE Askare(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  info varchar(200) NOT NULL,
  deadline DATE NOT NULL,
  tarkeysaste INTEGER,
  kayttaja varchar(50) REFERENCES Kayttaja
);
CREATE TABLE Luokka(
  name varchar(50) PRIMARY KEY NOT NULL
);
CREATE TABLE Muistilista(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  kayttaja varchar(50) REFERENCES Kayttaja
);
CREATE TABLE AskareMuistilista(
  id SERIAL PRIMARY KEY,
  askareid INTEGER REFERENCES Askare(id),
  muistilistaid INTEGER REFERENCES Muistilista(id)
);
CREATE TABLE AskareLuokka(
  id SERIAL PRIMARY KEY,
  askareid INTEGER REFERENCES Askare(id),
  luokkaid INTEGER REFERENCES Luokka(id)
);
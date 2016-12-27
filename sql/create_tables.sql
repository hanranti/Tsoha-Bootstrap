-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja(
  name varchar(50) PRIMARY KEY NOT NULL,
  password varchar(50) NOT NULL
);
CREATE TABLE Askare(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  info varchar(50) NOT NULL,
  deadline TIMESTAMP NOT NULL,
  tarkeysaste INTEGER,
  kayttaja varchar(50) REFERENCES Kayttaja
);
CREATE TABLE Luokka(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL
);
CREATE TABLE Muistilista(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL
);
CREATE TABLE AskareMuistilista(
  id SERIAL PRIMARY KEY,
  askareid INTEGER REFERENCES Askare(id),
  muistilistaid INTEGER REFERENCES Muistilista(id)
);
CREATE TABLE MuistilistaLuokka(
  id SERIAL PRIMARY KEY,
  muistilistaid INTEGER REFERENCES Muistilista(id),
  luokkaid INTEGER REFERENCES Luokka(id)
);
-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Visitor(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);
CREATE TABLE Chore(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  info varchar(200) NOT NULL,
  deadline DATE NOT NULL,
  importancedegree INTEGER,
  visitorid INTEGER REFERENCES Visitor(id)
);
CREATE TABLE Category(
  name varchar(50) PRIMARY KEY NOT NULL
);
CREATE TABLE Checklist(
  id SERIAL PRIMARY KEY,
  name varchar(50) NOT NULL,
  visitorid INTEGER REFERENCES Visitor(id)
);
CREATE TABLE ChoreChecklist(
  id SERIAL PRIMARY KEY,
  choreid INTEGER REFERENCES Chore(id),
  checklistid INTEGER REFERENCES Checklist(id)
);
CREATE TABLE ChoreCategory(
  id SERIAL PRIMARY KEY,
  choreid INTEGER REFERENCES Chore(id),
  category varchar(50) REFERENCES Category(name)
);

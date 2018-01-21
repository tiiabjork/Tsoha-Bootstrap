CREATE TABLE Kayttaja(
  id SERIAL PRIMARY KEY, 
  kayttajatunnus varchar(50) NOT NULL, 
  salasana varchar(50) NOT NULL
);

CREATE TABLE Askare(
  atunnus SERIAL PRIMARY KEY,
  laatija INTEGER REFERENCES Kayttaja(id),
  nimi varchar(120) NOT NULL,
  kiireellisyys INTEGER NOT NULL,
  lisatiedot varchar(500),
  status INTEGER NOT NULL
);

CREATE TABLE Luokka(
  ltunnus SERIAL PRIMARY KEY,
  laatija INTEGER REFERENCES Kayttaja(id),
  nimi varchar(120) NOT NULL
);

CREATE TABLE Askareen_luokka(
  atunnus INTEGER REFERENCES Askare(atunnus), 
  ltunnus INTEGER REFERENCES Luokka(ltunnus)
);
CREATE TABLE Kayttaja(
  kayttaja_id SERIAL PRIMARY KEY, 
  kayttajatunnus varchar(50) NOT NULL, 
  salasana varchar(50) NOT NULL
);

CREATE TABLE Askare(
  atunnus SERIAL PRIMARY KEY,
  laatija INTEGER REFERENCES Kayttaja(kayttaja_id),
  kuvaus varchar(120) NOT NULL,
  kiireellisyys INTEGER,
  onkoLuokkia boolean DEFAULT FALSE
);

CREATE TABLE Luokka(
  ltunnus SERIAL PRIMARY KEY,
  laatija INTEGER REFERENCES Kayttaja(kayttaja_id), 
  luokkakuvaus varchar(20)
);

CREATE TABLE Askareen_luokka(
  atunnus INTEGER REFERENCES Askare(atunnus), 
  ltunnus INTEGER REFERENCES Luokka(ltunnus)
);
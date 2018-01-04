-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja (kayttajatunnus, salasana)
VALUES ('Ville', 'omena123');

INSERT INTO Luokka (laatija, kuvaus)
VALUES (1, 'Kotihommat');

INSERT INTO Luokka (laatija, kuvaus)
VALUES (1, 'Kouluhommat');

INSERT INTO Askare (laatija, nimi, kiireellisyys, lisatiedot, status)
VALUES (1, 'Tiskivuoren tuhoaminen', 5, 'Jepjep', 1);

INSERT INTO Askare (laatija, nimi, kiireellisyys, lisatiedot, status)
VALUES (1, 'Kandin palautus', 4, 'Muista lisätä loppusanat ja oikea päivämäärä etulehtiöön. Lisäksi tarkista ohjaajan virallinen nimike netistä.', 1);

INSERT INTO Askare (laatija, nimi, kiireellisyys, status)
VALUES (1, 'Osta uusi reppu', 2, 1);

INSERT INTO Askare (laatija, nimi, kiireellisyys, status)
VALUES (1, 'Ikkunoiden pesu', 0, 0);

INSERT INTO Askare (laatija, nimi, kiireellisyys, status)
VALUES (1, 'Koiran lenkitys' , 0, 0);

-- Lisätään "Osta uusi reppu:lle kummatkin luokat"
INSERT INTO Askareen_luokka (atunnus, ltunnus)
VALUES (3, 1);

INSERT INTO Askareen_luokka (atunnus, ltunnus)
VALUES (3, 2);

-- Lisätään Tiskivuorelle (1) kotityö ja kandille (2) koulutyö
INSERT INTO Askareen_luokka (atunnus, ltunnus)
VALUES (1, 1);

INSERT INTO Askareen_luokka (atunnus, ltunnus)
VALUES (2, 2);

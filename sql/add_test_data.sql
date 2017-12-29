-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja (kayttajatunnus, salasana)
VALUES ('Ville', 'omena123');

INSERT INTO Kayttaja (kayttajatunnus, salasana) 
VALUES ('Mia', 'koira');

INSERT INTO Luokka (laatija, kuvaus)
VALUES (1, 'Kotityo');

INSERT INTO Luokka (laatija, kuvaus)
VALUES (1, 'Kouluhomma');

INSERT INTO Askare (laatija, kuvaus, kiireellisyys, luokat)
VALUES (1, 'Tiskivuoren tuhoaminen', 5, 0);

INSERT INTO Askare (laatija, kuvaus, kiireellisyys, luokat)
VALUES (1, 'Kandin palautus', 4, 0);

INSERT INTO Askare (laatija, kuvaus, kiireellisyys, luokat)
VALUES (2, 'Imurointi', 2, 0);

INSERT INTO Askare (laatija, kuvaus)
VALUES (2, 'Ikkunoiden pesu');

INSERT INTO Askare (laatija, kuvaus)
VALUES (2, 'Koiran lenkitys');


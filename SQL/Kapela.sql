SELECT k.nazev_kapely, k.rok_zalozeni::VARCHAR, k.rok_ukonceni::VARCHAR, k.mesto, s.nazev AS stat_nazev, z.popis AS zanr_popis FROM kapela k NATURAL JOIN stat s NATURAL JOIN zanr z WHERE k.nazev_kapely ilike '%:vyhledat%' or k.rok_zalozeni::VARCHAR ilike '%:vyhledat%' or k.rok_ukonceni::VARCHAR ilike '%:vyhledat%' or k.mesto ilike 'vyhledat' or s.nazev ilike '%:vyhledat%' or z.popis ilike '%:vyhledat%' ORDER BY nazev_kapely ASC;

CREATE TABLE zanr (
    zanr_id serial PRIMARY KEY,
    popis VARCHAR(20) UNIQUE NOT NULL
);

CREATE TABLE stat (
    stat_id serial PRIMARY KEY,
    zkratka varchar(2) UNIQUE NOT NULL ,
    nazev VARCHAR(100) NOT NULL
);

--alter table kapela rename column zanr to zanr_id;
--alter table stat rename column popis to nazev;
--alter table kapela rename column stat to stat_id;

create table kapela  (
    kapela_id serial PRIMARY KEY,
    nazev_kapely VARCHAR(150) UNIQUE NOT NULL ,
    rok_zalozeni INTEGER NOT NULL ,
    rok_ukonceni INTEGER,
    zanr_id INTEGER REFERENCES zanr(zanr_id),
    mesto VARCHAR(50) NOT NULL,
    stat_id INTEGER REFERENCES stat(stat_id)
);
alter table kapela
    ADD CONSTRAINT rok_zalozeni_chk CHECK (rok_zalozeni BETWEEN 1900 AND to_char(now(),'YYYY')::integer),
    ADD CONSTRAINT rok_ukonceni_chk CHECK (rok_ukonceni BETWEEN 1900 AND to_char(now(),'YYYY')::integer OR null);

CREATE TABLE album (
                       album_id serial PRIMARY KEY,
                       kapela_id INTEGER REFERENCES kapela(kapela_id) NOT NULL ,
                       nazev VARCHAR(100) NOT NULL,
                       vydano INTEGER NOT NULL
);
alter table album
    ADD CONSTRAINT vydano_chk CHECK (vydano BETWEEN 1900 AND to_char(now(),'YYYY')::integer);

CREATE TABLE pisen (
                       pisen_id serial PRIMARY KEY,
                       album_id INTEGER REFERENCES album(album_id) NOT NULL ,
                       nazev VARCHAR(100) NOT NULL ,
                       delka varchar(5) NOT NULL
);

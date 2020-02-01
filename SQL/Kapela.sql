drop table zanr;
drop table stat;
drop table kapela;
drop table album;
drop table pisen;
drop table uzivatel;

CREATE TABLE zanr (
    zanr_id serial PRIMARY KEY,
    popis VARCHAR(20) UNIQUE NOT NULL
);

CREATE TABLE stat (
    stat_id serial PRIMARY KEY,
    zkratka varchar(2) UNIQUE NOT NULL ,
    nazev VARCHAR(100) NOT NULL
);


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

CREATE TABLE uzivatel (
                         user_id SERIAL PRIMARY KEY NOT NULL,
                         user_name VARCHAR(150) NOT NULL,
                         login VARCHAR(150) UNIQUE NOT NULL,
                         password VARCHAR(255) NOT NULL,
                         role VARCHAR(20) NOT NULL
);

--alter table uzivatel drop constraint user_pkey;
--alter table uzivatel add constraint "user_pkey" PRIMARY KEY (user_id);

CREATE TABLE oblibena_kapela(
    user_id INTEGER REFERENCES uzivatel(user_id) NOT NULL,
    kapela_id INTEGER REFERENCES kapela(kapela_id) NOT NULL
);
ALTER TABLE oblibena_kapela ADD CONSTRAINT "oblibena_kapela_pkey" PRIMARY KEY (user_id, kapela_id);
